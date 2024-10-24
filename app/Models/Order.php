<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Nom de la table
    protected $primaryKey = 'order_id'; // Clé primaire

    // Colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'user_id',
        'total_price',
        'order_date',
        'status',
    ];

    // Relation : une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation : une commande peut avoir plusieurs détails de commande
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
