@extends('layouts.main')

@section('content')
    <div class="mb-4">
        <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-badge fs-4 text-muted me-2"></i>
            <h4 class="fw-bold mb-0 me-2 text-primary">{{ $employee->user->name }}</h4>
            <span class="badge border rounded-pill text-muted fw-normal">Public</span>
        </div>

        <div class="border-bottom">
            <nav class="nav gh-tabs">
                <a class="nav-link active fw-bold text-dark border-bottom border-warning border-2" href="#"><i
                        class="bi bi-code me-2"></i>Profile Readme</a>
                <a class="nav-link text-muted" href="#"><i class="bi bi-clock-history me-2"></i>Attendance Log <span
                        class="badge bg-light text-dark rounded-pill">{{ $employee->attendances->count() }}</span></a>
                <a class="nav-link text-muted" href="#"><i class="bi bi-calendar-x me-2"></i>Leave Requests <span
                        class="badge bg-light text-dark rounded-pill">{{ $employee->leaves->count() }}</span></a>
                <a class="nav-link text-muted" href="#"><i class="bi bi-gear me-2"></i>Settings</a>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="gh-box mb-4">
                <div class="gh-box-header py-2 bg-light d-flex justify-content-between align-items-center">
                    <div class="small">
                        <span class="fw-bold">{{ $employee->user->name }}</span>
                        <span class="text-muted">updated profile details</span>
                        <span class="text-muted">{{ $employee->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="small text-muted">Latest commit {{ substr($employee->nip, 0, 7) }}</div>
                </div>
                <div class="gh-box-body p-4">
                    <h3 class="border-bottom pb-2 mb-3">Hi there 👋</h3>
                    <p>I am working as <strong>{{ $employee->position->title }}</strong> at
                        <strong>{{ $employee->department->name }}</strong> department.</p>

                    <h5 class="mt-4">Employee Details</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">🆔 <strong>NIP:</strong> <code>{{ $employee->nip }}</code></li>
                        <li class="mb-2">📧 <strong>Email:</strong> <a href="#">{{ $employee->user->email }}</a>
                        </li>
                        <li class="mb-2">📱 <strong>Phone:</strong> {{ $employee->phone }}</li>
                        <li class="mb-2">🏠 <strong>Address:</strong> {{ $employee->address }}</li>
                        <li class="mb-2">📅 <strong>Joined:</strong>
                            {{ \Carbon\Carbon::parse($employee->join_date)->format('d F Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-4">
                <h6 class="fw-bold mb-2">About</h6>
                <p class="small text-muted mb-3">
                    Information system profile page for {{ $employee->user->name }}.
                </p>

                <div class="d-flex align-items-center small text-muted mb-2">
                    <i class="bi bi-link-45deg me-2 fs-5"></i> <a href="#"
                        class="text-decoration-none fw-bold text-dark">tpl.co.id/staff</a>
                </div>
                <div class="d-flex align-items-center small text-muted mb-2">
                    <i class="bi bi-geo-alt me-2"></i> Sumatera Utara
                </div>
            </div>

            <div class="border-top pt-3 mb-4">
                <h6 class="fw-bold mb-2">Languages</h6>
                <div class="mb-2">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                        <div class="progress-bar bg-warning" style="width: 30%"></div>
                        <div class="progress-bar bg-danger" style="width: 10%"></div>
                    </div>
                </div>
                <div class="small">
                    <span class="me-3"><i class="bi bi-circle-fill text-primary small me-1"></i> PHP 60%</span>
                    <span class="me-3"><i class="bi bi-circle-fill text-warning small me-1"></i> HTML 30%</span>
                </div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-gh-default btn-sm">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection
