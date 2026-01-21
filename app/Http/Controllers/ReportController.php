<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // --- 1. DATA REAL UNTUK GRAFIK (30 Hari Terakhir) ---
        $startDate = Carbon::now()->subDays(29);
        $endDate = Carbon::now();

        $dailyAttendance = Attendance::select(DB::raw('DATE(date) as date'), DB::raw('count(*) as total'))
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date');

        $chartData = [];
        $totalEmployees = Employee::count();
        if ($totalEmployees == 0)
            $totalEmployees = 1;

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateString = $date->toDateString();
            $count = $dailyAttendance[$dateString]->total ?? 0;
            $chartData[] = [
                'date' => $date->format('d M'),
                'count' => $count,
                'percentage' => ($count / $totalEmployees) * 100
            ];
        }

        // --- 2. STATISTIK KEUANGAN ---
        $totalSalary = Payroll::sum('net_salary');
        $totalPayrollCount = Payroll::count();
        $approvedLeaves = Leave::where('status', 'approved')->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();

        // ==========================================
        //  INTI ALGORITMA (SAW & TOPSIS)
        // ==========================================

        $employees = Employee::with('attendances')->get();
        $dataset = []; // Menampung data mentah

        // A. Persiapan Data Mentah
        foreach ($employees as $emp) {
            // C1: Kehadiran (0-100)
            $presentCount = $emp->attendances->where('status', 'hadir')->count();
            $c1 = ($presentCount / 25) * 100;
            if ($c1 > 100)
                $c1 = 100;

            // C2: Loyalitas/Masa Kerja (0-100)
            $joinDate = Carbon::parse($emp->join_date);
            $monthsWorked = $joinDate->diffInMonths(Carbon::now());
            $c2 = ($monthsWorked / 24) * 100;
            if ($c2 > 100)
                $c2 = 100;

            $dataset[] = [
                'id' => $emp->id,
                'name' => $emp->user->name,
                'position' => $emp->position->title,
                'c1' => $c1, // Benefit
                'c2' => $c2  // Benefit
            ];
        }

        // --- ALGORITMA 1: SAW (Simple Additive Weighting) ---
        $sawRank = [];
        foreach ($dataset as $d) {
            // Rumus: (Nilai * Bobot) + ...
            $score = ($d['c1'] * 0.7) + ($d['c2'] * 0.3);

            if ($score >= 85)
                $grade = 'Top Performer';
            elseif ($score >= 70)
                $grade = 'Good';
            else
                $grade = 'Need Improvement';

            $sawRank[] = (object) [
                'name' => $d['name'],
                'position' => $d['position'],
                'attendance_score' => number_format($d['c1'], 1),
                'loyalty_score' => number_format($d['c2'], 1),
                'final_score' => number_format($score, 2),
                'grade' => $grade
            ];
        }
        // Urutkan SAW (Highest to Lowest)
        usort($sawRank, fn($a, $b) => $b->final_score <=> $a->final_score);
        $topPerformersSAW = array_slice($sawRank, 0, 5);


        // --- ALGORITMA 2: TOPSIS ---
        // Langkah 1: Pembagi Normalisasi (Akar dari jumlah kuadrat)
        $div_c1 = 0;
        $div_c2 = 0;
        foreach ($dataset as $d) {
            $div_c1 += pow($d['c1'], 2);
            $div_c2 += pow($d['c2'], 2);
        }
        $div_c1 = sqrt($div_c1);
        $div_c2 = sqrt($div_c2);

        // Prevent division by zero
        if ($div_c1 == 0)
            $div_c1 = 1;
        if ($div_c2 == 0)
            $div_c2 = 1;

        // Langkah 2 & 3: Normalisasi Terbobot (Y) & Solusi Ideal (A+ / A-)
        $topsisData = [];
        $y1_values = [];
        $y2_values = [];

        foreach ($dataset as $d) {
            // Normalisasi * Bobot
            $y1 = ($d['c1'] / $div_c1) * 0.7;
            $y2 = ($d['c2'] / $div_c2) * 0.3;

            $topsisData[] = [
                'name' => $d['name'],
                'position' => $d['position'],
                'y1' => $y1,
                'y2' => $y2
            ];
            $y1_values[] = $y1;
            $y2_values[] = $y2;
        }

        // Tentukan Ideal Positif (Max karena Benefit) & Negatif (Min)
        $a_plus = !empty($y1_values) ? [max($y1_values), max($y2_values)] : [0, 0];
        $a_min = !empty($y1_values) ? [min($y1_values), min($y2_values)] : [0, 0];

        // Langkah 4 & 5: Jarak Solusi & Nilai Preferensi (V)
        $topsisRank = [];
        foreach ($topsisData as $d) {
            // Jarak ke Positif (D+)
            $d_plus = sqrt(pow($d['y1'] - $a_plus[0], 2) + pow($d['y2'] - $a_plus[1], 2));
            // Jarak ke Negatif (D-)
            $d_min = sqrt(pow($d['y1'] - $a_min[0], 2) + pow($d['y2'] - $a_min[1], 2));

            // Preferensi (V)
            $v = ($d_min + $d_plus) != 0 ? $d_min / ($d_min + $d_plus) : 0;

            $topsisRank[] = (object) [
                'name' => $d['name'],
                'position' => $d['position'],
                'preference' => number_format($v, 4) // 4 desimal agar presisi
            ];
        }

        // Urutkan TOPSIS (Highest to Lowest)
        usort($topsisRank, fn($a, $b) => $b->preference <=> $a->preference);
        $topPerformersTOPSIS = array_slice($topsisRank, 0, 5);

        return view('reports.index', compact(
            'chartData',
            'totalSalary',
            'totalPayrollCount',
            'approvedLeaves',
            'pendingLeaves',
            'topPerformersSAW',
            'topPerformersTOPSIS'
        ));
    }
}
