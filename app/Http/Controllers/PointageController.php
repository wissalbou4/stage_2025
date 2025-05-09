<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commande;
use App\Models\Etat;
use App\Models\Pointage;
use Carbon\Carbon;

class PointageController extends Controller
{
    public function index()
{
    // $commande = Commande::latest()->first(); // ou une commande par défaut
    // $user = User::first(); // ou l'utilisateur connecté
    // $etats = Etat::all(); // tous les états

    return view('pointage.index');
}
public function show(Request $request)
{
    // Récupérer tous les états
    $etats = Etat::all();

    // Vérifier si une commande existe déjà et la conserver
    $commande = session('commande', null);

    // Rechercher la commande uniquement si un ID est fourni
    if ($request->commande_id) {
        $commande = Commande::with(['client', 'etat', 'type'])->find($request->commande_id);
        // Stocker la commande pour qu’elle reste affichée
        session(['commande' => $commande]);
    }

    // Rechercher l'utilisateur uniquement si un ID est fourni
    $user = null;
    if ($request->user_id) {
        $user = User::with('etat')->find($request->user_id);
    }

    return view('pointage.index', compact('commande', 'user', 'etats'));
}


    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
        ]);

        $commande = Commande::find($request->commande_id);

        Pointage::create([
            'user_id' => auth()->id(),
            'commande_id' => $commande->id,
            'etat' => $commande->etat->etat,
            'date' => Carbon::now()->toDateString(),
            'heure' => Carbon::now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Pointage enregistré.');
    }

    public function updateEtat(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'etat_id' => 'required|exists:etats,id',
            'commande_id' => 'nullable|exists:commandes,id',
        ]);

        $user = User::find($request->user_id);
        $etat = Etat::find($request->etat_id);

        $user->etat_id = $etat->id;
        $user->save();

        Pointage::create([
            'user_id' => $user->id,
            'commande_id' => $request->commande_id,
            'etat' => $etat->etat,
            'date' => Carbon::now()->toDateString(),
            'heure' => Carbon::now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'État mis à jour et pointage enregistré.');
    }
}
