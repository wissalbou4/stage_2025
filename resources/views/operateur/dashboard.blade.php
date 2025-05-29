@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Bienvenue, {{ $user->name }}</h3>
    <p>Rôle : <span class="badge bg-primary">{{ $user->etat->role }}</span></p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-info mb-3">
                <div class="card-header text-dark">
                    <i class="fas fa-pencil-alt"></i> Commandes en saisie
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $countSaisie }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning mb-3">
                <div class="card-header text-dark">
                    <i class="fas fa-truck-loading"></i> Commandes Traitées
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $countRamassage }}</h5>
                </div>
            </div>
        </div>
         <!-- Nombre de clients -->
         <div class="col-md-4">
            <div class="card bg-success mb-3">
                <div class="card-header text-dark">
                    <i class="fas fa-users"></i> Nombre de clients
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $countClients }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
