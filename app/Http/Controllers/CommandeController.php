<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Etat;
use App\Models\Type;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
{
    $role = auth()->user()->etat->role;
    $search = request('search'); // <== ÉTAPE 1

    $query = Commande::with(['client', 'etat', 'type']);

    // <== ÉTAPE 2 : Ajoute la condition de recherche ici
    if ($search) {
        $query->whereHas('client', function ($q) use ($search) {
            $q->where('nom', 'like', "%$search%")
              ->orWhere('prenom', 'like', "%$search%");
        });
    }

    // Conditions par rôle (comme dans ton code)
    if ($role === 'operateur') {
        $query->where('etat_id', Etat::where('etat', 'en saisie')->value('id'));
    } elseif ($role === 'ramasseur') {
        $query->where('etat_id', Etat::where('etat', 'en ramassage')->value('id'));
    } elseif ($role === 'controleur') {
        $query->where('etat_id', Etat::where('etat', 'Contrôle')->value('id'));
    } elseif ($role === 'caissier') {
        $query->where('etat_id', Etat::where('etat', 'Caisse')->value('id'));
    } elseif ($role !== 'admin') {
        abort(403, 'Accès interdit');
    }

    $commandes = $query->orderBy('created_at', 'desc')->get();

    return match ($role) {
        'admin' => view('admin.commandes.index', compact('commandes')),
        'operateur' => view('operateur.commandes.index', compact('commandes')),
        'ramasseur' => view('ramasseur.commandes.index', compact('commandes')),
        'controleur' => view('controleur.commandes.index', compact('commandes')),
        'caissier' => view('caissier.commandes.index', compact('commandes')),
    };
}

    

    public function create()
    {
        $clients = Client::all();
        $types = Type::all();
        $role = auth()->user()->etat->role;

        if ($role === 'admin') {
            return view('admin.commandes.create', compact('clients', 'types'));
        }

        if ($role === 'operateur') {
            return view('operateur.commandes.create', compact('clients', 'types'));
        }

        abort(403, 'Accès interdit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'sexe' => 'required|in:Fille,Garçon',
            'client_id' => 'required|exists:clients,id',
            'type_id' => 'required|exists:types,id',
        ]);

        $commande = new Commande();
        $commande->date = $request->date;
        $commande->sexe = $request->sexe;
        $commande->client_id = $request->client_id;
        $commande->type_id = $request->type_id;

        //  État par défaut : "en saisie"
        $commande->etat_id = Etat::where('etat', 'en saisie')->value('id');

        //  Code-barres EAN-128 avec millisecondes
        $commande->code_barre = $this->generateEAN128();

        $commande->save();

        $role = auth()->user()->etat->role;
        return redirect()->route($role . '.commandes.index')
                         ->with('success', 'Commande créée avec succès.');
    }

    public function edit($id)
    {
        $commande = Commande::findOrFail($id);
        $clients = Client::all();
        $types = Type::all();
        $role = auth()->user()->etat->role;

        // Uniquement l’opérateur peut modifier si l’état est "en saisie"
        if ($role === 'operateur' && $commande->etat->etat !== 'en saisie') {
            abort(403, 'Modification interdite à ce stade.');
        }

        if ($role === 'admin') {
            return view('admin.commandes.edit', compact('commande', 'clients', 'types'));
        }

        if ($role === 'operateur') {
            return view('operateur.commandes.edit', compact('commande', 'clients', 'types'));
        }

        abort(403, 'Accès interdit');
    }

    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'sexe' => 'required|in:Fille,Garçon',
            'client_id' => 'required|exists:clients,id',
            'type_id' => 'required|exists:types,id',
        ]);

        $commande->update($request->only('date', 'sexe', 'client_id', 'type_id'));

        $role = auth()->user()->etat->role;
        return redirect()->route($role . '.commandes.index')
                         ->with('success', 'Commande mise à jour.');
    }

    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);

        if (auth()->user()->etat->role !== 'admin') {
            abort(403, 'Seul l’administrateur peut supprimer une commande.');
        }

        $commande->delete();

        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée.');
    }

    //  Génère un code-barres EAN-128 basé sur date + heure + ms
    private function generateEAN128()
    {
        $microtime = microtime(true); // timestamp avec microsecondes
        $milliseconds = sprintf('%02d', ($microtime - floor($microtime)) * 1000);
        $milliseconds = substr($milliseconds, 0, 2); 

        return date('YmdHis') . $milliseconds; 
    }
}
