@extends("layouts.index")
@section("content")
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
                        @foreach ($categories as $category)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="/products/category/{{$category->id}}">{{$category->name}}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div><!--/category-products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <form class="" action="/products/priceRange" method="get">
                                {{-- {{csrf_field()}} --}}
                                <input type="text" class="span2" value="" data-slider-min="500" data-slider-max="10000" data-slider-step="5" data-slider-value="[500,10000]" id="sl2" name="price"><br />
                                <b class="pull-left">500</b> <b class="pull-right">10,000</b>
                                <input type="submit" name="" value="ค้นหา" class="btn btn-primary">
                            </form>
                        </div>
                    </div><!--/price-range-->
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                  <div class="col-sm-5">
                    <div class="view-product">
                    <img src="{{asset('images/product_image/'.$product->image)}}" alt="" />
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                      <img src="{{asset('images/product-details/new.jpg')}}" class="newarrival" alt="" />
                      <h2>{{$product->name}}</h2>
                      <p>{{$product->description}}</p>
                      <img src="images/product-details/rating.png" alt="" />
                      <span>
                        <form action="/products/addQuantityToCart" method="post">
                            {{ csrf_field() }}
                            <span>{{number_format($product->price)}}</span>
                            <input type="hidden" name="_id" value="{{$product->id}}">
                        <label>Quantity:</label>
                        <input type="text" value="1" name="quantity" />
                        <button type="submit" class="btn btn-fefault cart">
                          <i class="fa fa-shopping-cart"></i>
                          Add to cart
                        </button>
                      </span>
                        </form>
                      <p><b>Category:</b>
                        <a href="/products/category/{{$product->category->id}}">{{$product->category->name}}</a>
                      </p>
                      <a href=""><img src="{{asset('images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                    </div><!--/product-information-->
                  </div>
                </div><!--/product-details-->
            </div>
        </div>
    </div>
</section>

@endsection
