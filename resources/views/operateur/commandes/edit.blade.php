@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la commande </h2>

    <form action="{{ route('operateur.commandes.update', $commande->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" value="{{ $commande->date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sexe</label>
            <select name="sexe" class="form-control" required>
                <option value="Fille" {{ $commande->sexe == 'Fille' ? 'selected' : '' }}>Fille</option>
                <option value="Garçon" {{ $commande->sexe == 'Garçon' ? 'selected' : '' }}>Garçon</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $commande->client_id ? 'selected' : '' }}>
                        {{ $client->nom }}  {{ $client->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type_id" class="form-control" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $commande->type_id ? 'selected' : '' }}>
                        {{ $type->type_fornit }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
