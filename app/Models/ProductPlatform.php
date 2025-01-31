<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductPlatform extends Pivot
{
    use HasFactory;

    /**
     * Nom explicite de la table pivot.
     */
    protected $table = 'product_platform';

    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'product_id',
        'platform_id',
    ];

    /**
     * Relation : Un ProductPlatform appartient à un produit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relation : Un ProductPlatform appartient à une plateforme.
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
}
