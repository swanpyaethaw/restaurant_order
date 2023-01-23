@extends('layouts.app')

@section('title','Order Details')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Order Details
                    <a href="{{ url('admin/orders') }}" class="btn btn-danger float-end mb-3">Back</a>
                </h3>
            </div><hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Receipe Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $orderItem)
                            <tr>
                                <td>{{ $orderItem->order->id }}</td>
                                <td>{{ $orderItem->receipe->name }}</td>
                                <td>{{ $orderItem->receipe->price }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>
                                    <label class="badge bg-success">{{ $orderItem->status }}</label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
