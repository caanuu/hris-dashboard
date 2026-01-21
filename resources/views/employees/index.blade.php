@extends('layouts.main')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Sumber Daya Manusia</h5>
            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">+ Tambah Karyawan</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Tanggal Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $emp)
                        <tr>
                            <td>{{ $emp->nip }}</td>
                            <td>
                                <div class="fw-bold">{{ $emp->user->name }}</div>
                                <small class="text-muted">{{ $emp->user->email }}</small>
                            </td>
                            <td>{{ $emp->department->name }}</td>
                            <td>{{ $emp->position->title }}</td>
                            <td>{{ $emp->join_date }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
