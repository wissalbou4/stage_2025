@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{route('admin.users.store')}}">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $user->name ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $user->email ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           {{ !isset($user) ? 'required' : '' }}>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="etat_id" class="form-label">Rôle</label>
                    <select class="form-select" id="etat_id" name="etat_id" required>
                        @foreach($etats as $etat)
                        <option value="{{ $etat->id }}" 
                            {{ (old('etat_id', $user->etat_id ?? '') == $etat->id) ? 'selected' : '' }}>
                            {{ $etat->role }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection