@extends('layouts.app')

@section('content')
@php 
$clients=\App\Models\Client::all()
@endphp
<div class="container">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-users me-2"></i>Gestion des Clients
    </h2>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Nouveau Client
    </a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Telephone</th>
                <th>Secteur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->prenom }}</td>
                <td>{{ $client->adresse }}</td>
                <td>{{ $client->ville }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->secteur }}</td>
                <td>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr ?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
