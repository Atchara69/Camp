<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function paymentsPanel(){
        $payments=DB::table('payments')->paginate(10);
        return view('admin.paymentsPanel',["payments"=>$payments]);
    }
}
