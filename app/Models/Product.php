<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id',
        'release_date',
    ];

    /**
     * Relation : Un produit appartient à une catégorie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');  // Spécifier explicitement la clé étrangère si nécessaire
    }

    /**
     * Relation : Un produit peut être dans plusieurs paniers.
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
