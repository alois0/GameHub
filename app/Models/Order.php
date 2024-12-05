<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $champsorder = [
        'user_id','total_price','order_date','status'
    ];

    public function orderDetails()
        {
            return $this->hasMany(orderDetails::class,'order_id','order_id');
        }
    
}
