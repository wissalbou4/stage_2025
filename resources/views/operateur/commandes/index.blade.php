@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des commandes (Admin)</h2>
    <a href="{{ route('operateur.commandes.create') }}" class="btn btn-primary mb-3">Créer une commande</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code Barre</th>
                <th>Date</th>
                <th>Sexe</th>
                <th>Client</th>
                <th>Type</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->code_barre }}</td>
                <td>{{ $commande->date }}</td>
                <td>{{ $commande->sexe }}</td>
                <td>{{ $commande->client->nom }}</td>
                <td>{{ $commande->type->type_fornit }}</td>
                <td>{{ $commande->etat->etat }}</td>
                <td>
                    <a href="{{ route('operateur.commandes.edit', $commande->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
