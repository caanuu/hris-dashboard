@extends('layouts.main')
@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="gh-card p-3">
                <h6 class="fw-bold mb-3">Buat Pengajuan Cuti</h6>
                <form action="{{ route('leaves.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="small text-muted">Karyawan</label>
                        <select name="employee_id" class="form-select form-select-sm">
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label class="small text-muted">Mulai</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-6">
                            <label class="small text-muted">Selesai</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Alasan</label>
                        <textarea name="reason" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>
                    <button class="btn btn-primary btn-sm w-100">Ajukan Cuti</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="gh-card">
                <div class="gh-card-header bg-light py-2 px-3 fw-bold small text-secondary">
                    Daftar Permintaan Cuti
                </div>
                <table class="table table-hover mb-0 small">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td class="fw-bold">{{ $leave->employee->user->name }}</td>
                                <td>{{ $leave->start_date }} s/d {{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>
                                    @if ($leave->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($leave->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($leave->status == 'pending')
                                        <form action="{{ route('leaves.update', $leave->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('PUT')
                                            <button name="status" value="approved"
                                                class="btn btn-xs btn-outline-success px-1 py-0"><i
                                                    class="bi bi-check"></i></button>
                                            <button name="status" value="rejected"
                                                class="btn btn-xs btn-outline-danger px-1 py-0"><i
                                                    class="bi bi-x"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
