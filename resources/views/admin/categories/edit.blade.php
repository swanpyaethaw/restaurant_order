@extends('layouts.admin')

@section('title','Edit Category')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Edit Category</h3>
            <a href="{{ url('admin/categories') }}" class="btn btn-danger">Back</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/categories/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="name" value="{{ old('name') ?? $category->name }}" class="form-control" id="category_name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') ?? $category->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image"><br>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($category->image)
                                <img src="{{ asset($category->image) }}" style="width:48px;height:48px"><br>
                                <a href="{{ url('admin/categories/'.$category->id.'/deleteCategoryImage') }}" style="text-decoration: none;">Remove</a>
                            @endif
                        </div>
                            <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
        </div>

    </div>
@endsection
