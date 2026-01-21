<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

// Redirect halaman awal langsung ke Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Hapus middleware(['auth']) agar tidak error minta login
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk Karyawan (CRUD)
Route::resource('employees', EmployeeController::class);
