<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\CompanyStructureController; // Controller Baru

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Manajemen Karyawan (CRUD Lengkap)
Route::resource('employees', EmployeeController::class);

// Struktur Organisasi (Hanya Lihat)
Route::get('/structure', [CompanyStructureController::class, 'index'])->name('structure.index');

// Absensi
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

// Cuti
Route::resource('leaves', LeaveController::class)->only(['index', 'store', 'update']);

// Penggajian
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
