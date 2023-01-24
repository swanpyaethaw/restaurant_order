<?php

namespace App\Http\Controllers\Cashier;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('order_status','completed')->get();
        return view('cashier.index',compact('orders'));
    }

    public function detail($orderId){
        $order = Order::where('id',$orderId)->first();
        $orderDetails = OrderDetail::where('order_id',$orderId)->where('status','served')->get();
        return view('cashier.detail',compact('orderDetails','order'));
    }

    public function viewInvoice($orderId){
        $order = Order::where('id',$orderId)->first();
        $orderDetails = OrderDetail::where('order_id',$orderId)->where('status','served')->get();
        return view('cashier.invoice',compact('orderDetails','order'));
    }

    public function generateInvoice($orderId){
        $order = Order::findOrFail($orderId);
        $order->order_status = 'paid';
        $order->save();
        $orderDetails = OrderDetail::where('order_id',$orderId)->where('status','served')->get();
        $data = ['order' => $order,'orderDetails' => $orderDetails];
        $pdf = Pdf::loadView('cashier.invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');

    }
}
