@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Créer une commande</h2>

    <form action="{{ route('operateur.commandes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sexe</label>
            <select name="sexe" class="form-control" required>
                <option value="Fille">Fille</option>
                <option value="Garçon">Garçon</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type_id" class="form-control" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_fornit }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
