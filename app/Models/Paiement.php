<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = ['commande_id', 'user_id', 'montant'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function caissier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
