@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des commandes </h2>
    <div class="row mb-3 align-items-center">
    <div class="col-md-4">
        <a href="{{ route('admin.commandes.create') }}" class="btn btn-primary">Créer une commande</a>
    </div>
    <div class="col-md-6">
    <form id="search-form" method="GET" action="{{ route('admin.commandes.index') }}">
    <div class="input-group">
        <span class="input-group-text bg-white">
            <i class="fas fa-search"></i>
        </span>
        <input type="text" id="search-input" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par nom de client">
    </div>
</form>
    </div>
</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>num_com</th>
                <th>Code Barre</th>
                <th>Date</th>
                <th>Sexe</th>
                <th>Client</th>
                <th>Type</th>
                <th>État</th>
                <th>Montant</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->code_barre }}</td>
                <td>{{ $commande->date }}</td>
                <td>{{ $commande->sexe }}</td>
                <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                <td>{{ $commande->type->type_fornit }}</td>
                <td>{{ $commande->etat->etat }}</td>
                <td>{{ $commande->paiement ? $commande->paiement->montant : 'N/A' }} DH</td> 
                <td>
                    <a href="{{ route('admin.commandes.edit', $commande->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('admin.commandes.destroy', $commande->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                    <a href="{{ route('admin.pointage.historique', $commande->id) }}" class="btn btn-sm btn-info">Historique</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("search-input");
        const form = document.getElementById("search-form");

        let timer;
        input.addEventListener("input", function () {
            clearTimeout(timer);
            const value = input.value.trim();

            if (value.length >= 3) {
                timer = setTimeout(() => {
                    form.submit();
                }, 500); // délai pour éviter trop de requêtes
            }
        });
    });
</script>