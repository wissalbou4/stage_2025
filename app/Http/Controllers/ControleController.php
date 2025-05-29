<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etat;
use App\Models\Commande;

class ControleController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    $etatControle = Etat::where('etat', 'controle')->first();
    $etatCaisse = Etat::where('etat', 'caisse')->first();

    if (!$etatControle || !$etatCaisse) {
        return back()->withErrors("États 'controle' ou 'caisse' non trouvés.");
    }

    // Commandes à contrôler
    $commandesAControler = Commande::where('etat_id', $etatControle->id)->with('client')->get();

    // Commandes déjà envoyées à la caisse
    $commandesEnvoyees = Commande::where('etat_id', $etatCaisse->id)->get();

    return view('controleur.dashboard', [
        'user' => $user,
        'commandesAControler' => $commandesAControler,
        'nombreAControler' => $commandesAControler->count(),
        'nombreEnvoyees' => $commandesEnvoyees->count(),
    ]);
}

}
