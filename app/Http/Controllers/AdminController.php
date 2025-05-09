<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etat;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get role statistics
        $roleStats = Etat::withCount('users')->get()->mapWithKeys(function ($etat) {
            return [$etat->role => $etat->users_count];
        });
        
        return view('admin.dashboard', [
            'user' => auth()->user(),
            'roleStats' => $roleStats
        ]);
    }
}
