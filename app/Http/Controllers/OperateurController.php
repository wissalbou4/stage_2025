<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Etat;
use App\Models\Client;

class OperateurController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    $etatSaisie = Etat::where('etat', 'en saisie')->first();
    $etatRamassage = Etat::where('etat', 'en ramassage')->first();

    if (!$etatSaisie || !$etatRamassage ) {
        return back()->withErrors("Un ou plusieurs états sont introuvables.");
    }

    // Comptages
    $countSaisie = Commande::where('etat_id', $etatSaisie->id)->count();
    $countRamassage = Commande::where('etat_id', $etatRamassage->id)->count();
    $countClients = Client::count();
    return view('operateur.dashboard', compact(
        'user',
        'countSaisie',
        'countRamassage',
        'countClients'
    ));
}

}
