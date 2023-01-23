@extends('layouts.admin')

@section('title','User Management')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Users List</h3>
            <a href="{{ url('admin/users/create') }}" class="btn btn-success">Create User</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @switch($user->role_id)
                                @case(1)
                                    <span class="badge bg-success">{{ $user->role->name }}</span>
                                    @break

                                @case(2)
                                    <span class="badge bg-warning">{{ $user->role->name }}</span>
                                    @break

                                @case(3)
                                    <span class="badge bg-primary">{{ $user->role->name }}</span>
                                    @break

                                @case(4)
                                    <span class="badge bg-secondary">{{ $user->role->name }}</span>
                                    @break

                                @default

                            @endswitch



                        </td>
                        <td>
                            @if ($user->id != Auth::user()->id)
                                <div class="d-flex">
                                    <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-primary me-2">Edit</a>
                                    <form action="{{ url('admin/users/'.$user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                    </form>
                                </div>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Receipe Available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
