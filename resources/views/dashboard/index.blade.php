@extends('layouts.main')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-secondary">Dashboard HRIS</h2>
            <p class="text-muted">Selamat datang di Sistem Informasi SDM PT Toba Pulp Lestari</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow h-100">
                <div class="card-body">
                    <div class="text-uppercase small fw-bold mb-1">Total Karyawan</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalEmployees }}</div>
                    <small class="text-white-50">Orang terdaftar</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body">
                    <div class="text-uppercase small fw-bold mb-1">Hadir Hari Ini</div>
                    <div class="h3 mb-0 fw-bold">{{ $presentToday }}</div>
                    <small class="text-white-50">Fitur segera hadir</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow h-100">
                <div class="card-body">
                    <div class="text-uppercase small fw-bold mb-1">Pengajuan Cuti</div>
                    <div class="h3 mb-0 fw-bold">{{ $pendingLeaves }}</div>
                    <small class="text-muted">Fitur segera hadir</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 fw-bold text-primary">Aktivitas Terbaru</h6>
        </div>
        <div class="card-body text-center py-5 text-muted">
            <p>Belum ada data absensi yang terekam.</p>
        </div>
    </div>
@endsection
