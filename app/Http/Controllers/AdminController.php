<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etat;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Pointage;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get role statistics
        $roleStats = Etat::withCount('users')->get()->mapWithKeys(function ($etat) {
            return [$etat->role => $etat->users_count];
        });
        
        // Get total clients
        $totalClients = Client::count();
        
        // Get total commandes
        $totalCommandes = Commande::count();
        
        // Get today's pointages
        $pointagesToday = Pointage::whereDate('created_at', Carbon::today())->count();
        
        // Get active users (logged in today)
        $activeUsers = User::whereDate('updated_at', Carbon::today())->count();
        
        // Get recent commandes
        $recentCommandes = Commande::with('client')
            ->latest()
            ->take(5)
            ->get();
            
        // Get recent pointages
        $recentPointages = Pointage::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', [
            'user' => auth()->user(),
            'roleStats' => $roleStats,
            'totalClients' => $totalClients,
            'totalCommandes' => $totalCommandes,
            'pointagesToday' => $pointagesToday,
            'activeUsers' => $activeUsers,
            'recentCommandes' => $recentCommandes,
            'recentPointages' => $recentPointages
        ]);
    }
}