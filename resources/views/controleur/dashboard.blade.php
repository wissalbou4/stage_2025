@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tableau de bord Contrôleur</h2>

    <div class="alert alert-info">
        Bienvenue <strong>{{ $user->name }}</strong>, vous êtes connecté comme <strong>{{ $user->etat->role }}</strong>.
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
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Commandes à contrôler</h5>
                    <p class="card-text fs-4">{{ $nombreAControler }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Commandes envoyées à la caisse</h5>
                    <p class="card-text fs-4">{{ $nombreEnvoyees }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
