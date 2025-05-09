<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware pour s'assurer que l'utilisateur est authentifié
    }

    public function index()
    {
        $role = auth()->user()->etat->role; // Récupère le rôle de l'utilisateur connecté

        // Si l'utilisateur est admin, on affiche tous les clients
        if ($role == 'admin') {
            $clients = Client::all();
            return view('admin.clients.index', compact('clients'));
        }

        // Si l'utilisateur est opérateur, on affiche ses propres clients (ou d'autres conditions)
        if ($role == 'operateur') {
            $clients = Client::all();
            return view('operateur.clients.index', compact('clients'));
        }

        abort(403, 'Accès interdit'); // Si l'utilisateur n'est ni admin ni opérateur
    }

    public function create()
    {
        $role = auth()->user()->etat->role;
        
        if ($role == 'admin') {
            return view('admin.clients.create');
        }

        if ($role == 'operateur') {
            return view('operateur.clients.create');
        }

        abort(403, 'Accès interdit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'telephone' => 'required|string',
            'secteur' => 'required|string',
        ]);

        Client::create($request->all());
        
        // On redirige vers la vue appropriée selon le rôle
        $role = auth()->user()->etat->role;
        if ($role == 'admin') {
            return redirect()->route('admin.clients.index')->with('success', 'Client créé avec succès.');
        }

        if ($role == 'operateur') {
            return redirect()->route('operateur.clients.index')->with('success', 'Client créé avec succès.');
        }

        abort(403, 'Accès interdit');
    }

    public function edit(Client $client)
    {
        $role = auth()->user()->etat->role;

        if ($role == 'admin') {
            return view('admin.clients.edit', compact('client'));
        }

        if ($role == 'operateur') {
            return view('operateur.clients.edit', compact('client'));
        }

        abort(403, 'Accès interdit');
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'telephone' => 'required|string',
            'secteur' => 'required|string',
        ]);

        $client->update($request->all());
        
        // On redirige vers la vue appropriée selon le rôle
        $role = auth()->user()->etat->role;
        if ($role == 'admin') {
            return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour avec succès.');
        }

        if ($role == 'operateur') {
            return redirect()->route('operateur.clients.index')->with('success', 'Client mis à jour avec succès.');
        }

        abort(403, 'Accès interdit');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client supprimé avec succès.');
    }
       
}
