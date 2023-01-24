@extends('layouts.app')

@section('title','Order List')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Order List</h3>
            </div><hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Table No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->table->table_no }}</td>
                                <td>
                                    <label class="badge bg-success">{{ $order->order_status }}</label>
                                </td>
                                <td>
                                    <a href="{{ url('cashier/order-details/'.$order->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
