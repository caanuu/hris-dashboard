@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                <h4 class="fw-normal mb-0">Add a new employee</h4>
            </div>

            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                <div class="gh-box p-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold small mb-1">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Budi Santoso"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="budi@tpl.co.id" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-bold small mb-1">NIP (ID Number)</label>
                            <input type="text" name="nip" class="form-control" placeholder="TPL-XXXX" required>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold small mb-1">Department</label>
                            <select name="department_id" class="form-select">
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold small mb-1">Position</label>
                            <select name="position_id" class="form-select">
                                @foreach ($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold small mb-1">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Employee's residence address"></textarea>
                        <div class="form-text small">Add details about the employee's current location.</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold small mb-1">Phone Number</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small mb-1">Join Date</label>
                            <input type="date" name="join_date" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employees.index') }}" class="btn btn-gh-default">Cancel</a>
                    <button type="submit" class="btn btn-gh-primary">Submit new employee</button>
                </div>
            </form>
        </div>
    </div>
@endsection
