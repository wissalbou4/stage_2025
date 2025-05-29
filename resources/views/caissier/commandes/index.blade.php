@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Commandes en Caisse</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Numéro</th>
                    <th>Code Barre</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($commandes as $commande)
                    <tr>
                        <form method="POST" action="{{ route('caissier.paiement') }}">
                            @csrf
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->code_barre }}</td>
                            <td>{{ $commande->date }}</td>
                            <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                            <td>{{ $commande->type->type_fornit }}</td>
                            <td>{{ $commande->etat->etat }}</td>

                            <td>
                                <input type="number" name="montant" step="0.01" min="0" class="form-control" required>
                            </td>

                            <input type="hidden" name="commande_id" value="{{ $commande->id }}">

                            <td>
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune commande en attente.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

       
    </div>
@endsection
