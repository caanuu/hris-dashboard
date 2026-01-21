@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="gh-box p-4 text-center">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=128"
                    class="rounded-circle mb-3 border">
                <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted small mb-3">{{ $employee->position->title ?? 'Staff' }} &bull;
                    {{ $employee->department->name ?? 'Umum' }}</p>

                @if ($attendanceToday)
                    <div class="alert alert-success border-success bg-success bg-opacity-10 py-2 small mb-0">
                        <i class="bi bi-check-circle-fill me-2"></i> Anda sudah absen masuk jam
                        <strong>{{ $attendanceToday->time_in }}</strong>
                    </div>
                @else
                    <div class="alert alert-warning border-warning bg-warning bg-opacity-10 py-2 small mb-3">
                        <i class="bi bi-exclamation-circle me-2"></i> Anda belum absen hari ini.
                    </div>
                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ $employee->id ?? '' }}">
                        <button type="submit" class="btn btn-gh-primary w-100">
                            <i class="bi bi-fingerprint me-2"></i> Absen Masuk Sekarang
                        </button>
                    </form>
                @endif
            </div>

            <div class="gh-box p-3 mt-3">
                <h6 class="fw-bold small text-muted mb-3 text-uppercase">Informasi Cuti</h6>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <span>Jatah Cuti Tahunan</span>
                    <span class="fw-bold">12 Hari</span>
                </div>
                <div class="d-flex justify-content-between align-items-center text-success">
                    <span>Sisa Cuti</span>
                    <span class="fw-bold fs-5">{{ $leaveBalance }} Hari</span>
                </div>
                <div class="d-grid mt-3">
                    <a href="{{ route('leaves.index') }}" class="btn btn-sm btn-gh-default">Ajukan Cuti Baru</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="gh-box">
                <div class="gh-box-header bg-light py-2">
                    <span class="fw-bold small"><i class="bi bi-clock-history me-2"></i> Riwayat Absensi Saya (5
                        Terakhir)</span>
                </div>
                @if ($recentActivities->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach ($recentActivities as $act)
                            <div class="list-group-item py-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($act->date)->format('l, d F Y') }}</h6>
                                        <small class="text-muted">Status: <span class="text-success">Hadir</span></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge border text-dark fw-normal bg-light">{{ $act->time_in }}</span>
                                        <small class="text-muted d-block mt-1">Masuk</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-calendar-x fs-1 mb-2 d-block"></i>
                        Belum ada riwayat absensi.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
