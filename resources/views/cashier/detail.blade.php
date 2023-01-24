{{-- @extends('layouts.app')

@section('title','Order Details')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Order Details
                    <a href="{{ url('cashier/orders') }}" class="btn btn-danger float-end mb-3">Back</a>
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

@endsection --}}
@extends('layouts.app')

@section('title','Order Detail')

@section('content')
    <div class="container bg-white my-3 ">
        <div class="row">
            <div class="col-md-12">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                            <h4 class="text-primary">
                                Order Details
                                <a href="{{ url('cashier/orders') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                                <a href="{{ url('cashier/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1">Download Invoice</a>
                                <a href="{{ url('cashier/invoice/'.$order->id) }}" class="btn btn-warning btn-sm float-end mx-1" target="_blank">View Invoice</a>
                            </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order Id: {{ $order->id }}</h6>
                                <h6>Table No: {{ $order->table->table_no }}</h6>
                                <h6>Ordered Date: {{ $order->created_at->format('d-m-Y H:i A') }}</h6>
                                <h6 class="border p-2 text-success">
                                    Order Status Message: <span class="text-uppercase">{{ $order->order_status }}</span>
                                </h6>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($orderDetails as $orderItem)
                                    <tr>
                                        <td width="10%">{{ $orderItem->id }}</td>
                                        <td width="10%">
                                            @if($orderItem->receipe->images)
                                                <img src="{{ asset($orderItem->receipe->images[0]->image) }}"  style="width:50px;height:50px" alt="">
                                            @else
                                                <img src=""  style="width:50px;height:50px" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $orderItem->receipe->name }}
                                        </td>

                                        <td width="10%">{{ $orderItem->receipe->price }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">${{ $orderItem->receipe->price * $orderItem->quantity }}</td>
                                    </tr>
                                    @php
                                        $totalPrice += $orderItem->receipe->price * $orderItem->quantity
                                    @endphp
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="5">Total Amount:</td>
                                    <td colspan="1">${{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                </div>
        </div>
    </div>



@endsection



