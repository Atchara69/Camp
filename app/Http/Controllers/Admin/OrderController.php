<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $orderitems=DB::table('orders')
        ->join('orderitems','orders.order_id','=','orderitems.order_id')
        ->where('orders.order_id',$id)
        ->get();
        return view('admin.orderDetails',["orderitems"=>$orderitems]);
  }
}
