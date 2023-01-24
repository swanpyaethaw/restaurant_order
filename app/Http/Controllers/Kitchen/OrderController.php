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

        // $order = Order::where('id',$orderDetail->order_id)->first();
        // $orderDetails = $order->orderDetails()->where('order_id',$order->id)->get();
        // $orderStatus = "";

        // foreach($orderDetails as $orderItem){
        //     if($orderItem->status == 'cancel'){
        //         $orderStatus = true;
        //     }else{
        //         $orderStatus = false;
        //         break;
        //     }
        // }

        // if($orderStatus == true){
        //     $order->order_status = 'cancel';
        //     $order->save();
        // }
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
