<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use App\Models\Etat;
use App\Models\Pointage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\CommandeEtatUpdated;
use App\Services\TwilioService; 
class PointageController extends Controller
{
    public function historique($id)
{
    $pointages = Pointage::with(['user', 'commande'])
                    ->where('commande_id', $id)
                    ->latest()
                    ->get();

    return view('admin.pointage.historique', compact('pointages'));
}

    public function index(Request $request)
    {
        $commande = null;
        $user = null;

        if ($request->has('commande_id')) {
            $commande = Commande::with(['client', 'etat'])->find($request->commande_id);
            $user = Auth::user();
        }

        $role = Auth::user()->etat->role ?? 'default';
        return view("{$role}.pointage.index", compact('commande', 'user'));
    }

    public function show(Request $request)
    {
        $etats = Etat::all();
        $commande = session('commande', null);

        if ($request->commande_id) {
            $commande = Commande::with(['client', 'etat', 'type'])->find($request->commande_id);
            session(['commande' => $commande]);
        }

        $user = null;
        if ($request->user_id) {
            $user = User::with('etat')->find($request->user_id);
        }

        $role = Auth::user()->etat->role ?? 'default';
        return view("{$role}.pointage.index", compact('commande', 'user', 'etats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
        ]);

        $commande = Commande::find($request->commande_id);
        $now = Carbon::now();

        Pointage::create([
            'user_id' => auth()->id(),
            'commande_id' => $commande->id,
            'etat' => $commande->etat->etat,
            'date' => $now->toDateString(),
            'heure' => $now->toTimeString(),
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

        $etat = Etat::find($request->etat_id);
        $commande = Commande::find($request->commande_id);
        $connectedUser = auth()->user();

        if ($connectedUser->etat->role !== 'admin' && $commande->etat->role !== $connectedUser->etat->role) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette commande.');
        }

        // Mettre à jour l'état de la commande
        $commande->etat_id = $etat->id;
        $commande->save();
        $commande->load(['etat', 'client']);

        // Enregistrer le pointage
        $now = Carbon::now();
        Pointage::create([
            'user_id' => $request->user_id,
            'commande_id' => $commande->id,
            'etat' => $etat->etat,
            'date' => $now->toDateString(),
            'heure' => $now->toTimeString(),
        ]);

        // 🔔 Notification interne
        $nextRole = $etat->role;
        $usersToNotify = User::whereHas('etat', fn($q) => $q->where('role', $nextRole))->get();
        Notification::send($usersToNotify, new CommandeEtatUpdated($commande));

        // Envoi WhatsApp si état == "expédition"
        if (strtolower($etat->etat) === 'expedition') {
            $telephone = $commande->client->telephone;

            // Formater si nécessaire
            if (preg_match('/^0[6-7][0-9]{8}$/', $telephone)) {
                $telephone = '+212' . substr($telephone, 1);
            }

            // Vérification du format international
            if (preg_match('/^\+212[6-7][0-9]{8}$/', $telephone)) {
                $message = "Bonjour {$commande->client->nom} {$commande->client->prenom}, votre commande N°{$commande->id} est prête à l'expédition. Merci de votre confiance.";
                try {
                    $twilio = new TwilioService();
                    $twilio->sendWhatsAppMessage($telephone, $message);
                } catch (\Exception $e) {
                    return back()->with('error', 'Erreur lors de l’envoi WhatsApp : ' . $e->getMessage());
                }
            } else {
                return back()->with('error', 'Numéro WhatsApp invalide pour le client.');
            }
        }

        session()->flash('etat_update', $commande->etat->etat);

        return redirect()->back()->with('success', 'État mis à jour, pointage enregistré et notifications envoyées.');
    }

}
