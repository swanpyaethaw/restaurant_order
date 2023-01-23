@extends('layouts.admin')

@section('title','Create Category')

@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h3>Create Category</h3>
            <a href="{{ url('admin/categories') }}" class="btn btn-danger">Back</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/categories') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="name" value="{{ old('name') ?? '' }}" class="form-control" id="category_name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') ?? '' }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
        </div>

    </div>
@endsection
