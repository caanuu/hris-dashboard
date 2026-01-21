<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect halaman awal langsung ke Dashboard (tanpa login dulu)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Hapus middleware(['auth']) sementara supaya tidak error
// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route Manajemen Karyawan (CRUD Lengkap)
Route::resource('employees', EmployeeController::class);

// Hapus baris di bawah ini yang bikin error:
// require __DIR__.'/auth.php';
