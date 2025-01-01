<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    /**
     * Relation : Une commande appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : Une commande a plusieurs détails de produits.
     */
    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}
}

