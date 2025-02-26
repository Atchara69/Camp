@extends('layouts.admin')
@section('body')
@if($order->count()>0)
<div class="table-responsive">
    <h2>Order Details </h2>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">Item Price</th>
            <th scope="col">Item Amount</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($order->order_detail as $orderitem)
        <tr>
        <th scope="row">{{$orderitem->product->id}}</th>
        <th scope="row">{{$orderitem->product->name}}</th>
        <th scope="row">{{$orderitem->item_price}}</th>
        <th scope="row">{{$orderitem->item_amount}}</th>

          </tr>
            @endforeach
        </tbody>
      </table>
    <a href="/admin/orders" class="btn btn-primary">Back</a>
</div>
@else
    <div class="alert alert-danger my-2">
        <p>ไม่มีข้อมูลสินค้าในใบสั่งซื้อ</p>
    </div>
@endif
@endsection

