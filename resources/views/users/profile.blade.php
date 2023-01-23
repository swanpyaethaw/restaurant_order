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
            <div class="col-md-12">
                <h1>User Profile
                    <a href="{{ url('admin/dashboard') }}" class="btn btn-danger float-end ms-3">Back</a>
                    <a href="{{ url('users/change-password') }}" class="btn btn-warning float-end">Change Password</a>
                </h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>User Details</h3>
                    </div>
                    <div class="card-body">
                        <div>
                            @if(auth()->user()->profile)
                                @if (auth()->user()->profile->image)
                                    <img src="{{ asset(auth()->user()->profile->image) }}" style="width:32px;height:32px;border-radius:50%" alt="User Image">
                                    <a href="{{ url('users/deleteProfileImage') }}">Remove</a>
                                @endif
                            @endif
                        </div>
                        <label><b>Name: </b>{{ auth()->user()->name }}</label><br>
                        <label><b>Email: </b>{{ auth()->user()->email }}</label><br>
                        <label><b>Role: </b><span class="badge bg-success">{{ auth()->user()->role->name }}</span></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ url('users/profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">User Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name  }}" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone No</label>
                        <input type="text" name="phone" value="{{ auth()->user()->profile->phone ?? '' }}" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control"   rows="3" id="address">{{ auth()->user()->profile->address ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image">Profile Image</label><br>
                        <input type="file" name="image">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
