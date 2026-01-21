<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- DASHBOARD KARYAWAN ---
        if ($user->role == 'karyawan') {
            // Ambil data Employee milik user yang login
            $employee = Employee::where('user_id', $user->id)->first();

            if (!$employee) {
                // Jika data employee belum di-link admin
                return view('dashboard.employee', [
                    'attendanceToday' => null,
                    'leaveBalance' => 0,
                    'recentActivities' => []
                ]);
            }

            // 1. Cek Absen Hari Ini
            $attendanceToday = Attendance::where('employee_id', $employee->id)
                ->whereDate('date', Carbon::today())
                ->first();

            // 2. Cek Sisa Cuti (Contoh: Total 12 - Yang Approved)
            $usedLeaves = Leave::where('employee_id', $employee->id)
                ->where('status', 'approved')
                ->count(); // Asumsi 1 request = 1 hari dulu
            $leaveBalance = 12 - $usedLeaves;

            // 3. Aktivitas Terakhir (Absen & Cuti)
            $recentActivities = Attendance::where('employee_id', $employee->id)
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.employee', compact('attendanceToday', 'leaveBalance', 'recentActivities', 'employee'));
        }

        // --- DASHBOARD ADMIN (Yang Lama) ---
        $today = Carbon::today();
        $totalEmployees = Employee::count();
        $presentToday = Attendance::whereDate('date', $today)->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();

        $recentActivities = Attendance::with('employee.user')
            ->latest()
            ->take(5)
            ->get(); // Ambil 5 absen terakhir semua org

        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'pendingLeaves',
            'recentActivities'
        ));
    }
}
