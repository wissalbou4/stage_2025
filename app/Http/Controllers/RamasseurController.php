<?php
namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Etat;
use Illuminate\Http\Request;

class RamasseurController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Recherche de l'état "en ramassage" et "ramassée"
        $etatEnRamassage = Etat::where('etat', 'en ramassage')->first();  // "en ramassage" ici
        $etatControle = Etat::where('etat', 'Controle')->first();

        // Vérification si les états existent
        if (!$etatEnRamassage || !$etatControle) {
            return back()->withErrors("États 'en ramassage' ou 'contorole' non trouvés.");
        }

        // Commandes en cours de ramassage (état "en ramassage")
        $commandesEnRamassage = Commande::where('etat_id', $etatEnRamassage->id)->with('client')->get();

        // Commandes déjà ramassées
        $commandesControllee = Commande::where('etat_id',  $etatControle->id)->get();

        // Retourner la vue avec les données
        return view('ramasseur.dashboard', [
            'user' => $user,
            'commandesEnRamassage' => $commandesEnRamassage,
            'nombreEnRamassage' => $commandesEnRamassage->count(),
            'nombreControllee' =>$commandesControllee->count(),
        ]);
    }

  
}
