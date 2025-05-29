@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Historique de la commande N°{{ $pointages->first()->commande->id ?? '' }}</h4>
        <a href="{{ route('admin.commandes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour aux commandes
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Rôle</th>
                <th>Commande</th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pointages as $pointage)
                <tr>
                    <td>{{ $pointage->user->name }}</td>
                    <td>{{ $pointage->user->etat->etat ?? '' }}</td>
                    <td>{{ $pointage->commande->id }}</td>
                    <td>{{ $pointage->created_at->format('d/m/Y') }}</td>
                    <td>{{ $pointage->created_at->format('H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucun pointage pour cette commande.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
