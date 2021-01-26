<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function order_item()
    {
        return $this->hasOne('App\Orderitem', 'product_id');
    }
}
