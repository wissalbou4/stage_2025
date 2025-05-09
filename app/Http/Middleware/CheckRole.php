<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user() || !$request->user()->etat) {
            abort(403, 'Utilisateur non authentifié ou sans rôle');
        }

        // Vérifie si le rôle de l'utilisateur est dans les rôles autorisés
        if (!in_array($request->user()->etat->role, $roles)) {
            abort(403, 'Accès non autorisé. Rôle requis: ' . implode(', ', $roles));
        }
        return $next($request);
    }
}
