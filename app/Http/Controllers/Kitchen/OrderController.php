<?php

namespace App\Http\Controllers\Kitchen;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(){
        $orderDetails = OrderDetail::whereIn('status',['new','pending'])->get();
        return view('kitchen.order',compact('orderDetails'));
    }

    public function pending($orderItemId){
        $orderDetail = OrderDetail::where('id',$orderItemId)->first();

        $orderDetail->update([
            'status' => 'pending'
        ]);
        return redirect()->back();
    }

    public function cancel($orderItemId){
        $orderDetail = OrderDetail::where('id',$orderItemId)->first();

        $orderDetail->update([
            'status' => 'cancel'
        ]);
        return redirect()->back();
    }

    public function ready($orderItemId){
        $orderDetail = OrderDetail::where('id',$orderItemId)->first();

        $orderDetail->update([
            'status' => 'ready'
        ]);
        return redirect()->back();
    }
}
