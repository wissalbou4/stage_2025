@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-cash-register me-2"></i>Dashboard Caissier</h3>

    <div class="row">
        <!-- Carte d'accueil -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Bienvenue <strong>{{ $user->name }}</strong></h5>
                    <p class="card-text">
                        Vous êtes connecté en tant que :
                        <span class="badge bg-primary">{{ $user->etat->role  }}</span>
                    </p>

                    <a href="{{ route('caissier.commandes.index') }}" class="btn btn-success mt-2">
                        <i class="fas fa-shopping-cart me-1"></i> Gérer les transactions
                    </a>
                </div>
            </div>
        </div>
        @php
        $notification = $user->unreadNotifications->first();
    @endphp

    @if($notification)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            🔔 <strong>Notification :</strong> {{ $notification->data['message'] ?? 'Nouvelle mise à jour' }}
            <a href="{{ route('notification.read', $notification->id) }}" class="btn-close" aria-label="Fermer"></a>
        </div>
    @endif
        <!-- Statistiques rapides -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-check-circle me-2"></i>Commandes traitées</h5>
                    <p class="display-6">{{ $commandesTraiteesCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-euro-sign me-2"></i>Total encaissé</h5>
                    <p class="display-6">{{ number_format($totalEncaisse, 2) }} DH</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-clock me-2"></i>Commandes en attente</h5>
                    <p class="display-6">{{ $commandesEnAttenteCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
