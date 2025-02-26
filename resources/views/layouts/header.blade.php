<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | CAMPING</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	  <link href="{{asset('css/main.css')}}" rel="stylesheet">
	  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
		{{-- Icon หน้า ShowProduct --}}
	  <link rel="icon" href="{{asset('images/imges-camping/logo.png')}}" type="image/png">
</head><!--/head-->
<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/products"><img src="{{asset('images/imges-camping/show-logo.png')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                @if (Auth::check())
                                    <li><a href="/home"><i class="fa fa-user"></i>My Account</a></li>
                                    <li><a href="/products/cart">
                                        @if (isset($cartItems))
                                            <span class="badge" style="background:red">{{$cartItems->totalQuantity}}</span>
                                        @endif
                                        <i class="fa fa-shopping-cart"></i>Cart</a></li>
                                    {{-- <li><a href="checkout.html"><i class="fa fa-credit-card"></i> Checkout</a></li> --}}
                                @else
                                    <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="/register"><i class="fa fa-user"></i> Register</a></li>
                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/products" class="active">Home</a></li>
								{{-- <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
								<li><a href="contact-us.html">Contact</a></li> --}}
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
                            <form class="" action="/products/search" method="get">
                                <input type="text" placeholder="Search" name="search"/>
                            </form>


						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							{{-- <li data-target="#slider-carousel" data-slide-to="2"></li> --}}
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<img src="{{asset('images/home/koko.jpg')}}" class="girl img-responsive" alt="" />
									{{-- <h1><span>CAMP</span>-SHOP</h1>
									<h2>เราจำหน่ายเป้แบคแพค
									เต็นท์ อุปกรณ์แคมป์ปิ้งเดินป่าและอุปกรณ์เดินทางท่องเที่ยวครบ</h2>

									<center><p><h2>" อย่าเสียดายเงิน <br>
										ถ้านั้นคือความสุขของคุณ อ่ะฮิๆๆ " </p></h2></center> --}}
									{{-- <button type="button" class="btn btn-default get">Get it now</button> --}}
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/home/showproduct.jpg')}}" class="girl img-responsive" alt="" />
									{{-- <img src="{{asset('images/home/pricing.png')}}"  class="pricing" alt="" /> --}}
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									{{-- <h1><span>E</span>-SHOPPER</h1>
									<h2>บริการ ทุกระดับประทับใจ</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button> --}}
									<img src="{{asset('images/home/off50.jpg')}}" class="girl img-responsive" alt="" />
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/home/totalproduct.jpg')}}" class="girl img-responsive" alt="" />
									{{-- <img src="{{asset('images/home/pricing.png')}}"  class="pricing" alt="" /> --}}
								</div>
							</div>

							{{-- <div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>รับประกันสินค้านาน 3 ปี</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('images/home/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div> --}}

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->
