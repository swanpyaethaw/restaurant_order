<?php

namespace App\Http\Controllers\Waiter;

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
        return redirect()->back();
    }
}
