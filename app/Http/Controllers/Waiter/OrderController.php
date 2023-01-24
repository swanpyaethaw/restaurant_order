<?php

namespace App\Http\Controllers\Waiter;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orderDetails = OrderDetail::where('status','ready')->get();
        return view('waiter.order',compact('orderDetails'));
    }

    public function serve($orderItemId){
        $orderDetail = OrderDetail::where('id',$orderItemId)->first();

        $orderDetail->update([
            'status' => 'served'
        ]);

        // $order = Order::where('id',$orderDetail->order_id)->first();
        // $orderDetails = $order->orderDetails()->where('order_id',$order->id)->get();
        // $orderStatus = "";

        // foreach($orderDetails as $orderItem){
        //     if($orderItem->status == 'served' || $orderItem->status == 'cancel'){
        //         $orderStatus = true;
        //     }else{
        //         $orderStatus = false;
        //         break;
        //     }
        // }

        // if($orderStatus == true){
        //     $order->order_status = 'completed';
        //     $order->save();
        // }

        return redirect()->back();
    }
}
