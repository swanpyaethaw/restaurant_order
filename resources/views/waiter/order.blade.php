@extends('layouts.app')

@section('title','Waiter Dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Waiter Order List</h3>
            </div><hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Table No</th>
                            <th>Receipe Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $orderItem)
                            <tr>
                                <td>{{ $orderItem->order->id }}</td>
                                <td>{{ $orderItem->order->table->table_no }}</td>
                                <td>{{ $orderItem->receipe->name }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>
                                    <label class="badge bg-success">{{ $orderItem->status }}</label>
                                </td>
                                <td>
                                    <a href="{{ url('waiter/serve/'.$orderItem->id) }}" class="btn btn-success">Served</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
