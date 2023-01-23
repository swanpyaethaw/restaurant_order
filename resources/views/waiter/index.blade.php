@extends('layouts.app')

@section('title','Waiter Dashboard')

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
                <h3>Waiter Dashboard
                    <a href="{{ url('waiter/orders') }}" class="btn btn-info float-end">Order List</a>
                </h3><hr>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Receipe List</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('waiter/orderSubmit') }}" method="POST">
                            <div class="row">
                                    @csrf
                                    @foreach ($receipes as $receipe)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{ asset($receipe->images[0]->image) }}" style="width: 200px;height:200px" alt=""><br>
                                                    <div class="mt-2">
                                                        <h5><b>{{ $receipe->name }}</b></h5>
                                                        <span class="text-primary">{{ $receipe->price }} ks</span><br>
                                                        <input type="number" name="quantity[{{ $receipe->id }}]" style="width: 80px" min="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                            </div>
                            <div class="row mt-3 ">
                                <div class="col-md-12 d-flex align-items-center justify-content-evenly">
                                    <div>
                                        <label>Select Table</label>
                                        <select name="table_id" class="form-control" style="width: 100px">
                                            <option value="">Select Table</option>
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}">{{ $table->table_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success">Order</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

