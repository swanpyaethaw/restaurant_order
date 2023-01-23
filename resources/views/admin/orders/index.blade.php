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
            <div class="col-md-3 mb-3">
                <label>Filter By Order Date</label>
                <form action="" method="GET">
                    <div class="mb-3">
                        <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </form>
            </div>
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
                                    <a href="{{ url('admin/order-details/'.$order->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>

@endsection
