@extends('layouts.admin')

@section('title','Create User')

@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h3>Create User</h3>
            <a href="{{ url('admin/users') }}" class="btn btn-danger">Back</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/users') }}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="name">User Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation">
                        </div>
                        <div class="mb-3">
                            <label>Select Role</label><br>
                            @foreach ($roles as $role)
                            <div>
                                <input type="radio" name="role_id" value="{{ $role->id }}" id="{{ $role->name }}" class="me-1">
                                <label for="{{ $role->name }}">{{ $role->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>

                </form>
            </div>
        </div>


    </div>
@endsection
