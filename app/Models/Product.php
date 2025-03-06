<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'release_date',
        'image_path',
        'created_at'
    ];

    /**
     * Relation : Un produit appartient à une catégorie.
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
            ->withPivot('quantity', 'price', 'platform_id'); // Ajoute platform_id
            
    }
    

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'product_platform', 'product_id', 'platform_id');
    }
    
    public function images()
{
    return $this->hasMany(ProductImage::class, 'product_id');
}

}
