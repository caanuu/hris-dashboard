@extends('layouts.main')

@section('content')
    <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h5 class="mb-0">Input Karyawan Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email (untuk Login)</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Departemen</label>
                        <select name="department_id" class="form-select">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Jabatan</label>
                        <select name="position_id" class="form-select">
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="join_date" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
