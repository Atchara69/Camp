<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_detail()
    {
        return $this->hasMany('App\Orderitem', 'order_id');
    }
}
