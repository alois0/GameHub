<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id'; // Specify custom primary key

    protected $fillable = ['product_name', 'description', 'price', 'image_path', 'category_id', 'platform_id'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id'); // Specify foreign key and owner key
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'platform_id'); // Specify foreign key and owner key
    }
}
