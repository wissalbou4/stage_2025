@extends('layouts.app')

@section('content')
    <h1>Commandes en controle</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>num_com</th>
                <th>Code Barre</th>
                <th>Date</th>
                <th>Client</th>
                <th>Type</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->code_barre }}</td>
                    <td>{{ $commande->date }}</td>
                    <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td>{{ $commande->type->type_fornit }}</td>
                    <td>{{ $commande->etat->etat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
