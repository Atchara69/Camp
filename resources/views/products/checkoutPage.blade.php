@extends("layouts.index")
@section("content")
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p> Shipping/Bill To</p>
                            <div class="form-one">
                                <form action="/products/createOrder" method="post" class="form-group">
                            {{csrf_field()}}
                                    <input type="text" name="email" placeholder="Email*" required value="{{ Auth::user()->email }}">
                                    <input type="text" name="fname" placeholder="First Name *" required value="{{ Auth::user()->name }}">
                                    <input type="text" name="lname" placeholder="Last Name *"  required>
                                    <input type="text" name="address" placeholder="Address 1 *" required>
                                    <input type="text" name="zip" placeholder="Zip / Postal Code *" required>
                                    <input type="text" name="phone" placeholder="Phone *"required>
                                    <button class="btn btn-default check_out" type="submit" name="submit" >Proceed To Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection
