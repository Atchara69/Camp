<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
