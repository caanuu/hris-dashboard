<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Pastikan Model Employee sudah ada

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk statistik dashboard
        // Karena fitur Absensi & Cuti belum dibuat, kita set 0 dulu agar tidak error

        $totalEmployees = Employee::count();
        $presentToday = 0; // Nanti kita update setelah fitur absensi jadi
        $pendingLeaves = 0; // Nanti kita update setelah fitur cuti jadi
        $recentActivities = []; // Kosong dulu

        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'pendingLeaves',
            'recentActivities'
        ));
    }
}
