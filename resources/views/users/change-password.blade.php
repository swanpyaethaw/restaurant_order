@extends('layouts.app')

@section('title','User Profile')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3>Change Password
                            <a href="{{ url('users/profile') }}" class="btn btn-danger float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users/change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="currentPassword" id="current_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="password" id="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="password-confirmation">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password-confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
