<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\OrderConfirmedNotification;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];




    public function confirmOrder()
    {
        $this->update(['status' => 'confirmed']);

        // Envoyer l'email à l'utilisateur
        $this->user->notify(new OrderConfirmedNotification($this));
    }

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

