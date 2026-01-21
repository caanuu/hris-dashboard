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

        // Ambil data absensi harian (Group by Date)
        $dailyAttendance = Attendance::select(DB::raw('DATE(date) as date'), DB::raw('count(*) as total'))
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date');

        $chartData = [];
        $totalEmployees = Employee::count();
        if ($totalEmployees == 0) $totalEmployees = 1;

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateString = $date->toDateString();
            $count = $dailyAttendance[$dateString]->total ?? 0;

            $chartData[] = [
                'date' => $date->format('d M'),
                'count' => $count,
                'percentage' => ($count / $totalEmployees) * 100
            ];
        }

        // --- 2. STATISTIK KEUANGAN & CUTI ---
        $totalSalary = Payroll::sum('net_salary');
        $totalPayrollCount = Payroll::count(); // Tambahan: Jumlah transaksi gaji
        $approvedLeaves = Leave::where('status', 'approved')->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();

        // --- 3. ALGORITMA PENILAIAN KINERJA (SAW) ---
        $employees = Employee::with('attendances')->get();
        $performanceData = [];

        foreach ($employees as $emp) {
            // Hitung Kehadiran (Bobot 70%)
            $presentCount = $emp->attendances->where('status', 'hadir')->count();
            $c1_score = ($presentCount / 25) * 100; // Normalisasi (asumsi 25 hari kerja)
            if($c1_score > 100) $c1_score = 100;

            // Hitung Masa Kerja (Bobot 30%)
            $joinDate = Carbon::parse($emp->join_date);
            $monthsWorked = $joinDate->diffInMonths(Carbon::now());
            $c2_score = ($monthsWorked / 24) * 100; // Normalisasi (target 2 tahun = 100)
            if($c2_score > 100) $c2_score = 100;

            $finalScore = ($c1_score * 0.7) + ($c2_score * 0.3);

            if ($finalScore >= 85) $grade = 'Top Performer';
            elseif ($finalScore >= 70) $grade = 'Good';
            else $grade = 'Need Improvement';

            $performanceData[] = (object) [
                'name' => $emp->user->name,
                'position' => $emp->position->title,
                'attendance_score' => number_format($c1_score, 1),
                'loyalty_score' => number_format($c2_score, 1),
                'final_score' => number_format($finalScore, 1),
                'grade' => $grade
            ];
        }

        // Ranking
        usort($performanceData, function($a, $b) {
            return $b->final_score <=> $a->final_score;
        });

        $topPerformers = array_slice($performanceData, 0, 5);

        return view('reports.index', compact(
            'chartData',
            'totalSalary',
            'totalPayrollCount',
            'approvedLeaves',
            'pendingLeaves',
            'topPerformers'
        ));
    }
}
