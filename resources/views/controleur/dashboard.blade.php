@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de bord Caissier</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bienvenue <strong>{{ $user->name }}</strong> !</p>
                    <p>Vous êtes connecté en tant que <span class="badge bg-primary">{{ $user->etat->etat }}</span></p>

                    <a href="#" class="btn btn-primary">
                        Gérer les transactions
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

