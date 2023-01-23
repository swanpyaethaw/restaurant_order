<?php

namespace App\Http\Controllers\Waiter;

use App\Models\Order;
use App\Models\Table;
use App\Models\Receipe;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function index(){
        $categories = Category::all();
        $receipes = Receipe::all();
        $tables = Table::all();

        return view('waiter.index',compact('categories','receipes','tables'));
    }

    public function saveOrder(Request $request){
        $request->validate([
            'table_id' => 'required',
        ]);

        $orders = $request->except('_token','table_id');
        $order_quantity = array_filter($orders['quantity']);

        if($order_quantity){
            $total = 0;
            foreach($order_quantity as $key => $value){
                $receipe = Receipe::find($key);
                $total += $receipe->price * $value;
            }

            $order = $this->orderSubmit($request,$total);

            foreach($order_quantity as $key => $value){
                $this->orderDetailSubmit($order,$key,$value);
            }
            return back()->with('message','Order Submitted Successfully');

        }else{
            return back()->with('message','Please add at least one receipe');
        }
    }

    public function orderSubmit($request,$total){
            $order = new Order;
            $order->table_id = $request->table_id;
            $order->total_amount = $total;
            $order->order_status = 'in progress';
            $order->save();
            return $order;
    }

    public function orderDetailSubmit($order,$key,$value){
            $order->orderDetails()->create([
                'order_id' => $order->id,
                'receipe_id' => $key,
                'quantity' => $value,
                'status' => 'new'
            ]);
        }

}
