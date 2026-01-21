@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="fs-5">
            <span class="fw-bold">Attendance Log</span>
        </div>

        <form action="{{ route('attendance.store') }}" method="POST" class="d-flex gap-2">
            @csrf
            <select name="employee_id" class="form-select form-select-sm" style="width: 200px;">
                <option value="">Switch branch/tag...</option>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->user->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-gh-primary btn-sm text-nowrap">Check In</button>
        </form>
    </div>

    <div class="gh-box">
        <div class="gh-box-header py-2 bg-light border-bottom fw-bold small">
            <div class="row w-100 m-0">
                <div class="col-3">Date</div>
                <div class="col-3">Employee</div>
                <div class="col-2">In</div>
                <div class="col-2">Out</div>
                <div class="col-2">Status</div>
            </div>
        </div>

        <div class="list-group list-group-flush">
            @foreach ($attendances as $att)
                <div class="list-group-item py-2 px-3 border-bottom" style="font-size: 14px;">
                    <div class="row align-items-center">
                        <div class="col-3 fw-mono text-muted small">{{ $att->date }}</div>
                        <div class="col-3 fw-bold text-dark">{{ $att->employee->user->name }}</div>
                        <div class="col-2 text-success">{{ $att->time_in }}</div>
                        <div class="col-2 text-danger">{{ $att->time_out ?? '-' }}</div>
                        <div class="col-2">
                            <span class="badge rounded-pill border fw-normal text-success bg-light">
                                <i class="bi bi-check me-1"></i> {{ ucfirst($att->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
