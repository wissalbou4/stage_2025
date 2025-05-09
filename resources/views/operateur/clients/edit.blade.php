@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-user-edit me-2"></i>Modifier le Client
    </h2>

    <form action="{{ route('operateur.clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

            <div class="col-md-6">
                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $client->nom) }}" required autocomplete="nom">

                @error('nom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong> 
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prenom') }}</label>

            <div class="col-md-6">
                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom', $client->prenom) }}" required autocomplete="prenom">

                @error('prenom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong> 
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse') }}</label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse', $client->adresse) }}" required autocomplete="adresse">

                @error('adresse')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> 
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="ville" class="col-md-4 col-form-label text-md-end">{{ __('Ville') }}</label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('ville') is-invalid @enderror" name="ville" value="{{ old('ville', $client->ville) }}" required autocomplete="ville">

                @error('ville')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> 
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone', $client->telephone) }}" required autocomplete="telephone">

                @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> 
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="secteur" class="col-md-4 col-form-label text-md-end">{{ __('Secteur') }}</label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('secteur') is-invalid @enderror" name="secteur" value="{{ old('secteur', $client->secteur) }}" required autocomplete="secteur">

                @error('secteur')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> 
                </span>
                @enderror
            </div>
            
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Modifier') }}
                </button>
                <a href="{{ route('operateur.clients.index') }}" class="btn btn-secondary">
                    {{ __('Annuler') }}
                </a>
            </div>
        </div>
        
    </form>
</div>
@endsection
