@extends('layouts.main')
@section('content')
    <h4 class="fw-bold mb-4">Struktur Organisasi Perusahaan</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="gh-card">
                <div class="gh-card-header bg-light fw-bold">Daftar Departemen</div>
                <ul class="list-group list-group-flush">
                    @foreach ($departments as $dept)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $dept->name }}
                            <span class="badge bg-primary rounded-pill">{{ $dept->employees_count }} Staff</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="gh-card">
                <div class="gh-card-header bg-light fw-bold">Level Jabatan</div>
                <ul class="list-group list-group-flush">
                    @foreach ($positions as $pos)
                        <li class="list-group-item">
                            {{ $pos->title }}
                            <span class="float-end text-muted small">Grade A</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
