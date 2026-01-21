<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Controller Auth
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\CompanyStructureController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

// --- 1. GUEST ROUTES (Belum Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// --- 2. AUTH ROUTES (Harus Login) ---
Route::middleware('auth')->group(function () {

    // Logout (Harus di dalam auth)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Redirect home ke dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard'); });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Karyawan
    Route::resource('employees', EmployeeController::class);

    // Struktur
    Route::get('/structure', [CompanyStructureController::class, 'index'])->name('structure.index');

    // Operasional
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::resource('leaves', LeaveController::class)->only(['index', 'store', 'update']);

    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');

    // Reports & Settings
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
});
