<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'platform_id', // Ajout de platform_id
        'quantity',
        'price_each',
        'address_id',
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

    /**
     * Relation : Un OrderDetail appartient à une plateforme.
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    public function address()
{
    return $this->belongsTo(Address::class);
}

}
