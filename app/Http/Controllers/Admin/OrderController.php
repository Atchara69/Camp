<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function orderPanel(){
        $orders=DB::table('orders')->paginate(10);
        return view('admin.OrderPanel',["orders"=>$orders]);
    }
    public function showOrderDetail($id){
        $order=Order::find($id);
        return view('admin.orderDetails',["order"=>$order]);
  }
}
