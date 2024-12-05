<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;


    protected $champsaremplie = [
        'product_name','description','price','stock_quantity','category_id','release_date','image'
    ];

    public function orderDetails()
    {
        return $this->hasMany(orderDetails::class,'product_id','id');
    }
}
