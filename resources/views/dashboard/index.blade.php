@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3 mb-4">
            <img src="https://ui-avatars.com/api/?name=TPL&background=0969da&color=fff&size=200"
                class="rounded-circle img-fluid border mb-3" style="width: 100%; max-width: 260px;">
            <h4 class="fw-bold mb-0">PT Toba Pulp Lestari</h4>
            <div class="text-muted fw-light mb-3">Sistem Informasi SDM</div>
            <button class="btn btn-gh-default w-100 btn-sm mb-3">Edit profile</button>

            <div class="small text-muted mb-2"><i class="bi bi-people me-2"></i> {{ $totalEmployees }} employees</div>
            <div class="small text-muted mb-2"><i class="bi bi-geo-alt me-2"></i> Sumatera Utara, ID</div>
            <div class="small text-muted"><i class="bi bi-link-45deg me-2"></i> <a href="#"
                    class="text-decoration-none">tobapulp.com</a></div>
        </div>

        <div class="col-md-9">
            <div class="mb-4">
                <h6 class="text-muted small mb-2">Pinned Overview</h6>
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="gh-box p-3 mb-0 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-journal-bookmark me-2 text-muted"></i>
                                <span class="fw-bold text-primary">Total Employees</span>
                                <span class="badge rounded-pill border ms-auto text-muted">Public</span>
                            </div>
                            <p class="small text-muted mb-3">Jumlah seluruh karyawan aktif yang terdaftar dalam sistem.</p>
                            <div class="d-flex align-items-center small">
                                <span class="d-inline-block rounded-circle bg-warning me-2"
                                    style="width: 10px; height: 10px;"></span>
                                Karyawan
                                <span class="ms-3 text-dark fw-bold">{{ $totalEmployees }} People</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="gh-box p-3 mb-0 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-journal-bookmark me-2 text-muted"></i>
                                <span class="fw-bold text-primary">Attendance Today</span>
                            </div>
                            <p class="small text-muted mb-3">Rekapitulasi kehadiran karyawan hari ini.</p>
                            <div class="d-flex align-items-center small">
                                <span class="d-inline-block rounded-circle bg-success me-2"
                                    style="width: 10px; height: 10px;"></span>
                                Vue
                                <span class="ms-3 text-dark fw-bold">{{ $presentToday }} Present</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="gh-box p-3 mb-0">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-journal-bookmark me-2 text-muted"></i>
                                <span class="fw-bold text-primary">Pending Leaves Requests</span>
                            </div>
                            <p class="small text-muted mb-0">Permintaan cuti yang menunggu persetujuan HR.</p>
                            <div class="mt-2 text-dark fw-bold">{{ $pendingLeaves }} Request(s)</div>
                        </div>
                    </div>

                </div>
            </div>

            <h6 class="text-muted small mb-2">Contribution Activity</h6>
            <div class="position-relative ps-3 border-start">
                @forelse($recentActivities as $activity)
                    <div class="mb-3">
                        <div class="small text-muted">{{ now()->format('M d') }}</div>
                        <div class="small">
                            <i class="bi bi-record-circle text-success me-1"></i>
                            User melakukan aktivitas...
                        </div>
                    </div>
                @empty
                    <div class="small text-muted fst-italic py-2">
                        No public activity in the last period.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
