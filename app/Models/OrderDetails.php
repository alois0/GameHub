<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{

    use HasFactory;

    protected $champsorderdetails = [
        'order_detail_id','order_id','product_id','quantity','price_each'
    ];

    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
