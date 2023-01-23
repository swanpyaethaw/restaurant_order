@extends('layouts.admin')

@section('title','Receipe Page')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Receipe List</h3>
            <a href="{{ url('admin/receipes/create') }}" class="btn btn-success">Create Receipe</a>
        </div><hr>
    </div>


    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 mb-3">
                <form action="" method="GET">
                    <div class="row">
                        <h5>Filter By Category</h5>
                        <div class="col-md-6">
                                <select name="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ Request::get('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </div>

                    </div>


                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($receipes as $receipe)
                    <tr>
                        <td>{{ $receipe->id }}</td>
                        <td>{{ $receipe->name }}</td>
                        <td>{{ $receipe->category->name }}</td>
                        <td>{{ $receipe->price }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ url('admin/receipes/'.$receipe->id.'/edit') }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ url('admin/receipes/'.$receipe->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Receipe Available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        {{ $receipes->appends(request()->input())->links() }}
    </div>
@endsection

{{-- @push('script')
    <script>
        $(document).ready(function () {
        $('#example').DataTable({
            "pageLength": 2
        });
    });
    </script>
@endpush --}}
