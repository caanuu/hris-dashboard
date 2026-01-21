@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Rekap Absensi Harian</h4>
        <form action="{{ route('attendance.store') }}" method="POST" class="d-flex gap-2">
            @csrf
            <select name="employee_id" class="form-select form-select-sm" style="width: 200px;" required>
                <option value="">-- Pilih Karyawan (Simulasi) --</option>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->user->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-fingerprint"></i> Absen Masuk</button>
        </form>
    </div>

    <div class="gh-card p-0 overflow-hidden">
        <table class="table table-hover mb-0 align-middle">
            <thead class="bg-light text-secondary small">
                <tr>
                    <th class="ps-3">TANGGAL</th>
                    <th>NAMA PEGAWAI</th>
                    <th>JAM MASUK</th>
                    <th>JAM KELUAR</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $att)
                    <tr>
                        <td class="ps-3">{{ $att->date }}</td>
                        <td class="fw-bold">{{ $att->employee->user->name }}</td>
                        <td class="text-success">{{ $att->time_in }}</td>
                        <td class="text-danger">{{ $att->time_out ?? '-' }}</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success border border-success">Hadir</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($attendances->isEmpty())
            <div class="p-4 text-center text-muted">Belum ada data absensi hari ini.</div>
        @endif
    </div>
@endsection
