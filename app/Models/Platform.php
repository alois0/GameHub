<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    /**
     * Nom explicite de la table.
     */
    protected $table = 'platform'; // Préciser que le nom de la table est 'platform'
    
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relation avec les produits.
     */
    public function products()
{
    return $this->belongsToMany(Product::class, 'product_platform', 'platform_id', 'product_id');
}

}
