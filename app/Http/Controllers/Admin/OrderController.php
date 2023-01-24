<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request){
        $today = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null,function($q) use ($request){
                        return $q->whereDate('created_at',$request->date);
                    },function($q) use($today){
                        return $q->whereDate('created_at',$today);
                    })
                  ->paginate(10);
        return view('admin.orders.index',compact('orders'));
    }

    public function detail($orderId){
        $orderDetails = OrderDetail::where('order_id',$orderId)->get();
        return view('admin.orders.detail',compact('orderDetails'));
    }

    public function complete($orderId){
        $order = Order::findOrFail($orderId);
        $order->order_status = 'completed';
        $order->save();
        return back();
    }

    public function cancel($orderId){
        $order = Order::findOrFail($orderId);
        $order->order_status = 'cancel';
        $order->save();
        return back();
    }


}
