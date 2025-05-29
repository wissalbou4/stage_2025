<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('etat')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $etats = Etat::all();
        return view('admin.users.create', compact('etats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'etat_id' => 'required|exists:etats,id',
            
        ]);
        // Générer un code barre unique
        $codeBarre = mt_rand(10000000, 99999999);

        // Vérifier si le code barre existe déjà dans la base de données
        while ($this->codeBarreExists($codeBarre)) {
            // Si oui, on génère un autre code barre
            $codeBarre = mt_rand(10000000, 99999999);
        }

        // Ajouter le code barre au request
        $request['code_barre'] = $codeBarre;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'etat_id' => $request->etat_id,
            'code_barre' => $codeBarre,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        $etats = Etat::all();
        return view('admin.users.edit', compact('user', 'etats'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'etat_id' => 'required|exists:etats,id',
            'codebarre' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'etat_id' => $request->etat_id,
            'codebarre' => $request->codebarre,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
    // gere le code barre automatique
    public function codeBarreExists($codeBarre)
    {
        return User::where('code_barre', $codeBarre)->exists();
    }
}