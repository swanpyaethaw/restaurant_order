@extends('layouts.admin')

@section('title','Edit User')

@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h3>Edit User</h3>
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
                <form action="{{ url('admin/users/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="name">User Name</label>
                            <input type="text" name="name" value="{{ $user->name  }}" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            <small class="text-danger">*This user has already password</small>
                        </div>
                        <div class="mb-3">
                            <label>Select Role</label><br>
                            @foreach ($roles as $role)
                            <div>
                                <input type="radio" name="role_id" value="{{ $role->id }}" id="{{ $role->name }}" {{ $user->role_id == $role->id ? 'checked' : '' }} class="me-1">
                                <label for="{{ $role->name }}">{{ $role->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>

                </form>
            </div>
        </div>


    </div>
@endsection
