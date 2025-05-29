<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    // retaion entre etat et commandes
    public function etat(){
        return $this->belongsTo(Etat::class);
    }
    // relations entre clients et commandes
    public function client(){
        return $this->belongsTo(Client::class);
    }
    // relation etre type et commandes
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
