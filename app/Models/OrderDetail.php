<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_each',
    ];

    /**
     * Relation : Un OrderDetail appartient à une commande.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relation : Un OrderDetail appartient à un produit.
     */
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
