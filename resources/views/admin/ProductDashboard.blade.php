@extends('layouts.admin')
@section('body')
@if($products->count()>0)
<div class="table-responsive">
    <h2>Product Dashboard</h2>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Edit Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
        <tr>
        <th scope="row">{{$product->id}}</th>
            <td>
                <img src="{{asset('images/product_image/'.$product->image)}}" alt="" width="100px" height="100px" >
                {{-- <img src="{{asset('storage/product_image/'.$product->image)}}" height="100" width="150"> --}}
            </td>
            <td>{{$product->name}}</td>
            <td>{{Str::limit($product->description,30)}}</td>
            <td>
                {{$product->category->name}}
            </td>
            <td>{{number_format($product->price)}}</td>
            <td>
                <a href="/admin/editProductImage/{{$product->id}}" class="btn btn-success">Edit Image</a>
            </td>
            <td>
                <a href="/admin/editProduct/{{$product->id}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <a href="/admin/deleteProduct/{{$product->id}}" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')" class="btn btn-danger">Remove</a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
      {{$products->links()}}
    </div>
@else
    <div class="alert alert-danger my-2">
        <p>ไม่มีข้อมูลสินค้า</p>
    </div>
@endif
@endsection

