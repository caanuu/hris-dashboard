@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="gh-box p-0 overflow-hidden">
                <div class="list-group list-group-flush">
                    <a href="#"
                        class="list-group-item list-group-item-action fw-bold border-start border-3 border-danger ps-3">Public
                        Profile</a>
                    <a href="#" class="list-group-item list-group-item-action text-muted">Account</a>
                    <a href="#" class="list-group-item list-group-item-action text-muted">Appearance</a>
                    <a href="#" class="list-group-item list-group-item-action text-muted">Accessibility</a>
                    <a href="#" class="list-group-item list-group-item-action text-muted">Notifications</a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <h4 class="fw-normal border-bottom pb-3 mb-4">Public Profile</h4>

            <form>
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="fw-bold small mb-1">Name</label>
                            <input type="text" class="form-control" value="Administrator">
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold small mb-1">Public Email</label>
                            <select class="form-select">
                                <option>admin@tpl.co.id</option>
                                <option>Do not show my email</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold small mb-1">Bio</label>
                            <textarea class="form-control" rows="3">Human Resources Manager at PT Toba Pulp Lestari.</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold small mb-1 d-block">Profile picture</label>
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random&size=200"
                            class="rounded-circle border mb-3 img-fluid">
                        <button class="btn btn-gh-default btn-sm w-100">Edit</button>
                    </div>
                </div>

                <h4 class="fw-normal border-bottom pb-3 mb-4 mt-5">Password & Authentication</h4>
                <div class="mb-3">
                    <button class="btn btn-gh-default text-danger">Change password</button>
                </div>

                <div class="mt-5 border-top pt-3">
                    <button class="btn btn-gh-primary">Update profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection
