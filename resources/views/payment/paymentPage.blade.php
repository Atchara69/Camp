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
                                           <div class="total_area" style="padding:10px">
                                            <ul>
                                                <li>Payment Status
                                                    @if($payment_info['status']=='Not Paid')
                                                    <span>ยังไม่ชำระเงิน</span>
                                                    @endif
                                                </li>
                                                <li>Total
                                                    <span>{{$payment_info['price']}}</span>

                                                <li>

                                                        <div id="paypal-button-container"></div>

                                                </li>
                                            </ul>
                                            {{-- <a class="btn btn-default update" href="">Update</a> --}}
                                          </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <script
    src="https://www.paypal.com/sdk/js?client-id=AaUoB5XZH-BPV4ASweZo2Kzqle8Ag2JeCjtJvKdxuU4txXFHuDAnVyk-CbHayPBTthgaksGBt7HPA_MC"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>
    <script>

        paypal.Buttons({
          createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '{{$payment_info['price']}}'
                }
              }]
            });
          },
          onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
              // This function shows a transaction success message to your buyer.
                    // console.log(data);
                    window.location='/paymentreceipt/'+data.orderID+'/'+data.payerID;
             });
          }
        }).render('#paypal-button-container');
        </script>
@endsection
