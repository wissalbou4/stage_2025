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
