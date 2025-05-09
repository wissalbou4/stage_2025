<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function showRegisterForm()
    {
        $etats = Etat::all();
        return view('auth.register', compact('etats'));
    }

    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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

        // Créer l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'etat_id' => $request->etat_id,
            'code_barre' => $codeBarre, // Ajouter le code barre ici
        ]);

        return redirect('/login')->with('success', 'Compte créé avec succès!');
    }

    public function redirectToDashboard()
    {
        $user = auth()->user();
        
        switch ($user->etat->role) {
            case 'admin':
                return redirect('/admin/dashboard')
                       ->with('welcome', 'Bienvenue Administrateur');
                
            case 'operateur':
                return redirect('/operateur/dashboard')
                       ->with('welcome', 'Espace Opérateur');
                
            case 'ramasseur':
                return redirect('/ramasseur/dashboard')
                       ->with('welcome', 'Espace Ramasseur');
                
            case 'controleur':
                return redirect('/controleur/dashboard')
                       ->with('welcome', 'Espace Contrôleur');
                
            case 'caissier':
                return redirect('/caissier/dashboard')
                       ->with('welcome', 'Espace Caissier');
                
            default:
                // Fallback pour les rôles inconnus
                Auth::logout();
                return redirect('/login')
                       ->with('error', 'Rôle non reconnu. Contactez l\'administrateur.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Vérifier si le code_barre existe déjà dans la base de données
    public function codeBarreExists($codeBarre)
    {
        return User::where('code_barre', $codeBarre)->exists();
    }
}
