<?php

namespace App\Models;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs massivement assignables.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ville',
        'rue',
        'codepostal',
        'user_role',
    ];

    /**
     * Les attributs masqués pour la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs castés.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relation : Un utilisateur possède un panier.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class); // Un utilisateur a un panier
    }

    /**
     * Relation : Un utilisateur peut avoir plusieurs numéros de téléphone.
     */
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'address_user', 'user_id', 'address_id')
                    ->withPivot('is_default') // Inclut 'is_default' dans la table pivot
                    ->using(UserAddress::class); // Utilise le modèle UserAddress comme pivot
                    
    }

public function defaultAddress()
{
    return $this->hasOne(UserAddress::class)
                ->where('is_default', 1)
                ->with('addresses');
}

public function isAdmin()
{
    return $this->user_role === 'admin';
}



}
