@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="fs-5">
            <span class="text-primary">tpl-hris</span> <span class="text-muted mx-1">/</span> <span
                class="fw-bold">employees</span>
            <span class="badge border text-muted ms-2 fw-normal rounded-pill">Public</span>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-gh-primary btn-sm">
            New Employee
        </a>
    </div>

    <div class="gh-box mb-0">
        <div class="gh-box-header py-2 bg-light border-bottom-0 rounded-top">
            <div class="d-flex align-items-center w-100">
                <div class="me-3 fw-bold small text-dark">
                    <i class="bi bi-people me-1"></i> {{ $employees->count() }} employees
                </div>
                <input type="text" class="form-control form-control-sm border-0 bg-transparent"
                    placeholder="Search files..." style="max-width: 200px; box-shadow: none;">
            </div>
        </div>

        <table class="table table-hover mb-0" style="font-size: 14px;">
            <tbody class="border-top">
                @foreach ($employees as $emp)
                    <tr>
                        <td class="px-3 py-2" style="width: 30px;">
                            <i class="bi bi-file-earmark text-muted"></i>
                        </td>
                        <td class="px-3 py-2">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('employees.show', $emp->id) }}"
                                    class="fw-bold text-dark text-decoration-none me-2">
                                    {{ $emp->user->name }}
                                </a>
                                <span class="badge border fw-normal text-muted bg-light">{{ $emp->position->title }}</span>
                            </div>
                        </td>
                        <td class="px-3 py-2 text-muted small text-end">
                            {{ $emp->department->name }}
                        </td>
                        <td class="px-3 py-2 text-end" style="width: 120px;">
                            <div class="btn-group">
                                <a href="{{ route('employees.edit', $emp->id) }}"
                                    class="btn btn-sm btn-link text-muted p-0 me-3"><i class="bi bi-pencil"></i></a>

                                <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this file?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-link text-danger p-0 border-0"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($employees->isEmpty())
            <div class="p-5 text-center text-muted">
                <h4>Welcome to your new repository!</h4>
                <p>You don't have any employees yet.</p>
            </div>
        @endif
    </div>
@endsection
