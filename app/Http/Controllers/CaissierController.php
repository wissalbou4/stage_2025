<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Etat;
use Illuminate\Http\Request;
use App\Models\Paiement;

class CaissierController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    $etatCaisse = Etat::where('etat', 'caisse')->first();
    $etatExpedition = Etat::where('etat', 'expedition')->first();

    if (!$etatCaisse || !$etatExpedition) {
        return back()->withErrors("États 'caisse' ou 'expédition' introuvables dans la table 'etats'.");
    }

    $commandesEnAttente = Commande::where('etat_id', $etatCaisse->id)->with('client')->get();
    $commandesExpediees = Commande::where('etat_id', $etatExpedition->id)->with('client')->get();

    $commandesEnAttenteCount = $commandesEnAttente->count();
    $commandesTraiteesCount = $commandesExpediees->count();

    // Calculer le total encaissé depuis la table paiements
    $totalEncaisse = Paiement::sum('montant');

    return view('caissier.dashboard', compact(
        'user',
        'commandesEnAttente',
        'commandesExpediees',
        'commandesEnAttenteCount',
        'commandesTraiteesCount',
        'totalEncaisse'
    ));
}


 

    public function enregistrerPaiement(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric|min:0',
        ]);

        $commande = Commande::findOrFail($request->commande_id);
        $etatExpedition = Etat::where('etat', 'expedition')->first();

        // Enregistrer le paiement dans une table séparée
        Paiement::create([
            'commande_id' => $commande->id,
            'user_id' => auth()->id(),
            'montant' => $request->montant,
        ]);

        

        return redirect()->back()->with('success', 'Paiement enregistré et commande validée.');
    }

        
        
}
