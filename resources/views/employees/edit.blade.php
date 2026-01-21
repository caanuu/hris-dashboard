@extends('layouts.main')

@section('content')
    <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold">Edit Data Karyawan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $employee->user->name }}"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $employee->user->email }}"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Departemen</label>
                        <select name="department_id" class="form-select">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Jabatan</label>
                        <select name="position_id" class="form-select">
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ $employee->position_id == $pos->id ? 'selected' : '' }}>
                                    {{ $pos->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Alamat</label>
                    <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">No HP</label>
                    <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
