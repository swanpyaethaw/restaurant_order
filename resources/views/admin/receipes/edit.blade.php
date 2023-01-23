@extends('layouts.admin')

@section('title','Edit Receipe')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Edit Receipe</h3>
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
                <form action="{{ url('admin/receipes/'.$receipe->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="receipe_name">Receipe Name</label>
                            <input type="text" name="name" value="{{  $receipe->name }}" class="form-control" id="receipe_name">
                        </div>
                        <div class="col-md-6">
                            <label for="category">Select Category</label>
                            <select name="category_id" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $receipe->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ $receipe->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{ $receipe->price }}" class="form-control" id="price">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="images">Upload Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                        </div>
                        <div>
                            @if($receipe->images)
                            <div class="row">
                                @foreach ($receipe->images as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset($image->image) }}" alt="" style="width: 48px;height:48px"><br>
                                        <a href="{{ url('admin/receipes/'.$image->id.'/deleteReceipeImage') }}" style="text-decoration: none;">Remove</a>
                                    </div>
                                @endforeach
                            </div>

                            @endif
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
