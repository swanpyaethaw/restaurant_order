<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice {{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Roulette</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: {{ $order->id }}</span> <br>
                    <span>Date: {{ date('d / m / Y') }}</span> <br>
                    <span>Phone no : 560077</span> <br>
                    <span>Address: #555, Main road, shivaji nagar, Bangalore, India</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th colspan="4">Order Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>
            </tr>

            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at->format('d-m-Y H:i:s A') }}</td>
            </tr>

            <tr>
                <td>Table No:</td>
                <td>{{ $order->table->table_no }}</td>
            </tr>

            <tr>
                <td>Order Status:</td>
                <td>{{ $order->order_status}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
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

                    <td>
                        {{ $orderItem->receipe->name }}
                    </td>

                    <td width="10%">{{ $orderItem->receipe->price }}</td>
                    <td width="10%">{{ $orderItem->quantity }}</td>
                    <td width="15%" class="fw-bold">${{ $orderItem->receipe->price * $orderItem->quantity }}</td>
                </tr>
                @php
                    $totalPrice += $orderItem->receipe->price * $orderItem->quantity
                @endphp
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">Total Amount:</td>
                <td colspan="1" class="total-heading">${{ $totalPrice }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank you
    </p>

</body>
</html>
