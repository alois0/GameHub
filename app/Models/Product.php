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
        'release_date',
        'image_path',
    ];

    public $timestamps = false; // Disable timestamps

    /**
     * Relation : Un produit appartient à plusieurs catégories.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    /**
     * Relation : Un produit peut être dans plusieurs paniers.
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products')
            ->withPivot('quantity', 'price', 'platform_id') // Ajoute platform_id
            ->withTimestamps();
    }

    /**
     * Relation : Un produit peut avoir plusieurs avis.
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    /**
     * Relation : Un produit peut être sur plusieurs plateformes.
     */
    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'product_platform', 'product_id', 'platform_id');
    }
}