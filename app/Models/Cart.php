<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Relation : Un panier appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation : Récupérer les produits dans le panier (via la table pivot cart_product).
     */
    public function products()
{
    return $this->belongsToMany(Product::class, 'cart_products')
                ->withPivot('quantity', 'price', 'platform_id');
               
}

}
