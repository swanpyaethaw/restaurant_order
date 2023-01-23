@extends('layouts.admin')

@section('title','Create Receipe')

@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h3>Create Receipe</h3>
            <a href="{{ url('admin/receipes') }}" class="btn btn-danger">Back</a>
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
                <form action="{{ url('admin/receipes') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="receipe_name">Receipe Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="receipe_name">
                        </div>
                        <div class="col-md-6">
                            <label for="category">Select Category</label>
                            <select name="category_id" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="price">
                        </div>
                        <div class="col-md-12">
                            <label for="images">Upload Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
