<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    // relation enter commande et type
    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
