@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Dashboard Overview</h4>
            <span class="text-muted small">Update terakhir: {{ now()->format('d M Y H:i') }}</span>
        </div>
        <button class="btn btn-sm btn-success fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Quick Action
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="gh-card h-100 mb-0">
                <div class="gh-card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-people-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Total
                            Karyawan</h6>
                        <h2 class="fw-bold mb-0">{{ $totalEmployees }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="gh-card h-100 mb-0">
                <div class="gh-card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-check-lg text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Hadir
                            Hari Ini</h6>
                        <h2 class="fw-bold mb-0">{{ $presentToday }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="gh-card h-100 mb-0">
                <div class="gh-card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0 text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Cuti
                            Pending</h6>
                        <h2 class="fw-bold mb-0">{{ $pendingLeaves }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="gh-card">
                <div class="gh-card-header">
                    <span><i class="bi bi-activity me-2"></i> Aktivitas HRIS Terbaru</span>
                    <a href="#" class="text-decoration-none small">Lihat semua</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($recentActivities as $activity)
                        <div class="list-group-item px-3 py-3">
                            {{ $activity }}
                        </div>
                    @empty
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-inbox fs-1 mb-2 d-block text-secondary"></i>
                            <span class="fw-bold text-dark">Belum ada aktivitas</span>
                            <p class="small">Data absensi atau cuti belum tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="gh-card">
                <div class="gh-card-header">
                    <span>Informasi Perusahaan</span>
                </div>
                <div class="gh-card-body">
                    <h6 class="fw-bold text-dark">PT Toba Pulp Lestari, Tbk.</h6>
                    <p class="text-muted small mb-3">
                        Aek Nauli, Kec. Parmaksian<br>
                        Kabupaten Toba, Sumatera Utara
                    </p>
                    <hr>
                    <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-outline-secondary text-start">
                            <i class="bi bi-file-earmark-text me-2"></i> Download Kebijakan HR
                        </button>
                        <button class="btn btn-sm btn-outline-secondary text-start">
                            <i class="bi bi-calendar3 me-2"></i> Kalender Libur 2026
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
