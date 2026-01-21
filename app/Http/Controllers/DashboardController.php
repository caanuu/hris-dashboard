<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalEmployees = Employee::count();
        $presentToday = Attendance::whereDate('date', $today)->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();

        // Ambil activity log campuran (Absen terakhir & Cuti terakhir)
        $recentActivities = collect(); // Bisa dikembangkan nanti

        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'pendingLeaves',
            'recentActivities'
        ));
    }
}
