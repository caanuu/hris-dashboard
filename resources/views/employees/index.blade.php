@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Daftar Karyawan</h4>
        <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm fw-bold">
            <i class="bi bi-plus-circle me-1"></i> Tambah Karyawan
        </a>
    </div>

    <div class="gh-card mb-3 p-2 bg-light d-flex gap-2">
        <input type="text" class="form-control form-control-sm" placeholder="Cari berdasarkan nama atau NIP...">
        <select class="form-select form-select-sm" style="width: 150px;">
            <option>Semua Dept</option>
            <option>Mill</option>
            <option>Plantation</option>
        </select>
        <button class="btn btn-sm btn-secondary">Filter</button>
    </div>

    <div class="gh-card">
        <div class="gh-card-header py-2 bg-light">
            <div class="d-flex align-items-center">
                <i class="bi bi-table me-2"></i> Data Pegawai Aktif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light text-secondary">
                    <tr style="font-size: 13px;">
                        <th class="ps-3 py-3">NIP</th>
                        <th>NAMA LENGKAP</th>
                        <th>DEPARTEMEN</th>
                        <th>JABATAN</th>
                        <th>BERGABUNG</th>
                        <th class="text-end pe-3">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $emp)
                        <tr style="font-size: 14px;">
                            <td class="ps-3 fw-mono text-muted">{{ $emp->nip }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $emp->user->name }}</div>
                                <div class="small text-muted" style="font-size: 12px;">{{ $emp->user->email }}</div>
                            </td>
                            <td>
                                <span class="badge border text-dark fw-normal bg-light">
                                    {{ $emp->department->name }}
                                </span>
                            </td>
                            <td>{{ $emp->position->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($emp->join_date)->format('d M Y') }}</td>
                            <td class="text-end pe-3">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($employees->isEmpty())
            <div class="p-4 text-center text-muted">
                <p>Belum ada data karyawan.</p>
            </div>
        @endif
    </div>
@endsection
