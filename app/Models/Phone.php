<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    /**
     * Nom de la table.
     */
    protected $table = 'phone';

    /**
     * Les attributs qui peuvent être massivement assignés.
     */
    protected $fillable = ['tel', 'user_id'];

    public $timestamps = false; // Désactive les timestamps

    /**
     * Relation : Un numéro appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
