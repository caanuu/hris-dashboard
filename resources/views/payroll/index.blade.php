@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Penggajian (Payroll)</h4>
        <form action="{{ route('payroll.store') }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm"><i class="bi bi-magic"></i> Generate Gaji Bulan Ini</button>
        </form>
    </div>

    <div class="gh-card">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-secondary small">
                <tr>
                    <th class="ps-3">PERIODE</th>
                    <th>KARYAWAN</th>
                    <th>JABATAN</th>
                    <th>GAJI POKOK</th>
                    <th>POTONGAN</th>
                    <th>TOTAL DITERIMA</th>
                    <th class="text-end pe-3">SLIP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payrolls as $pay)
                    <tr>
                        <td class="ps-3 fw-bold text-muted">{{ $pay->month }}</td>
                        <td class="fw-bold">{{ $pay->employee->user->name }}</td>
                        <td><span
                                class="badge border text-dark fw-normal">{{ $pay->employee->position->title ?? '-' }}</span>
                        </td>
                        <td>Rp {{ number_format($pay->basic_salary, 0, ',', '.') }}</td>
                        <td class="text-danger">Rp {{ number_format($pay->deduction, 0, ',', '.') }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($pay->net_salary, 0, ',', '.') }}</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($payrolls->isEmpty())
            <div class="p-5 text-center text-muted">Belum ada data penggajian periode ini.</div>
        @endif
    </div>
@endsection
