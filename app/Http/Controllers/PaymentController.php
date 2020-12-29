<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPayment($paypalOrderID,$payerID){


        $payment_info=Session::get('payment_info');
        $order_id=$payment_info['order_id'];
        $status=$payment_info['status'];

        if($status=='Not Paid'){
            //เปลี่ยนสถานะ Order

            DB::table('orders')->where('order_id',$order_id)->update(['status'=>'Complete']);

            //บันทึกข้อมูลการชำระเงิน
            $date=date("Y-m-d H:i:s");
            $newPayment=array(
                "date" =>$date,
                "amount"=>$payment_info['price'],
                "paypal_order_id"=>$paypalOrderID,
                "payer_id"=>$payerID,
                "order_id"=>$order_id

            );
            $create_Payment=DB::table('payments')->insert($newPayment);
            Session::forget('payment_info');
            return redirect('/products');

        }
    }
}
