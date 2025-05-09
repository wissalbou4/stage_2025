<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperateurController extends Controller
{
    public function dashboard()
    {
        return view('operateur.dashboard', [
            'user' => auth()->user()
        ]);
    }
}
