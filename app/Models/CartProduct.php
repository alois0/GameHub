<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    use HasFactory;

    protected $table = 'cart_products'; // Table pivot entre Cart et Product

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'platform_id', 
    ];

    /**
     * Relation : Un CartProduct appartient à un panier (via la table pivot).
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * Relation : Un CartProduct appartient à un produit (via la table pivot).
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
    
    public function getPlatformNameAttribute()
{
    return $this->platform_id ? Platform::find($this->platform_id)->name ?? 'Non spécifié' : 'Non spécifié';
}

    

    

}
