@extends('layouts.app')

@section('title','Kitchen Order')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Kitchen Order List</h3>
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
                                    @if ($orderItem->status == 'new')
                                        <a href="{{ url('kitchen/pending/'.$orderItem->id) }}" class="btn btn-primary">Pending</a>
                                        <a href="{{ url('kitchen/cancel/'.$orderItem->id) }}" class="btn btn-danger">Cancel</a>
                                    @endif
                                    @if ($orderItem->status == 'pending')
                                        <a href="{{ url('kitchen/ready/'.$orderItem->id) }}" class="btn btn-warning">Ready</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
