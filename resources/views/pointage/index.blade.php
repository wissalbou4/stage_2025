@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pointage</h2>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulaires de recherche --}}
    <div class="row">
        <div class="col-md-6">
            <!-- Recherche Commande (utilise GET) -->
            <form action="{{ route('pointage.show') }}" method="GET" class="card p-3 mb-4">
                
            <h5>Recherche Commande</h5>
                <label>ID Commande :</label>
                <input type="number" name="commande_id" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">Entrer</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{ route('pointage.show') }}" method="GET" class="card p-3 mb-4">
               
            <h5>Recherche Utilisateur</h5>
                <label>ID Utilisateur :</label>
                <input type="number" name="user_id" class="form-control mb-2" required>
                <button type="submit" class="btn btn-secondary">Entrer</button>
            </form>
        </div>

        {{-- Formulaire de validation de pointage --}}
        <div class="col-md-6">
            <h5>Détails Commande</h5>
            <form action="{{ route('pointage.store') }}" method="POST">
                @csrf
                <input type="hidden" name="commande_id" value="{{ $commande->id ?? '' }}">

                <div class="mb-2">Client :
                    <input class="form-control" value="{{ $commande->client->nom ?? '' }}" readonly>
                </div>
                <div class="mb-2">Sexe :
                    <input class="form-control" value="{{ $commande->sexe ?? '' }}" readonly>
                </div>
                <div class="mb-2">Type :
                    <input class="form-control" value="{{ $commande->type->type_fornit ?? '' }}" readonly>
                </div>
                <div class="mb-2">État :
                    <input class="form-control" value="{{ $commande->etat->etat ?? '' }}" readonly>
                </div>
                <div class="mb-2">Date :
                    <input class="form-control" value="{{ $commande->date ?? '' }}" readonly>
                </div>
                <div class="mb-2">
                    <label>Code-barres  :</label>
                    {!! DNS1D::getBarcodeHTML($commande->code_barre, 'C128', 2, 60) !!}
                    <p>{{ $commande->code_barre }}</p>
                </div>
            </form>
        </div>

        {{-- Formulaire de mise à jour de l'utilisateur --}}
        <div class="col-md-6">
            <h5>Détails Utilisateur</h5>
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : '#' }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">Nom :
                    <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}">
                </div>
                <div class="mb-2">Email :
                    <input type="email" name="email" class="form-control" value="{{ $user->email ?? '' }}">
                </div>
                <div class="mb-2">Rôle :
                    <input type="text" name="role" class="form-control" value="{{ $user->etat->role ?? '' }}">
                </div>
                <div class="mb-2">État :
                    <input type="text" name="etat" class="form-control" value="{{ $user->etat->etat ?? '' }}">
                </div>
                <div class="mb-2">
                    <label for="code_barre">code_barre:</label>
                    {!! DNS1D::getBarcodeHTML($user->code_barre, 'C128', 2, 60) !!}
                    <p>{{ $user->code_barre }}</p>
                </div>
            </form>
        </div>

        {{-- Formulaire de changement d’état --}}
        <div class="card p-3 mb-4">
            <h5>Changer l’état de l’utilisateur</h5>
            <form action="{{ route('pointage.user.update_etat') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
                <input type="hidden" name="commande_id" value="{{ $commande->id ?? '' }}">

                <div class="mb-2">
                    <label>Nouvel état :</label>
                    <select id="etatSelect" name="etat_id" class="form-control" style="display: none;">
                        <option value="">-- Choisir un état --</option>
                        @if(isset($etats))
                            @foreach($etats as $etat)
                                <option value="{{ $etat->id }}">{{ $etat->etat }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <button type="button" id="showEtatsBtn" class="btn btn-primary">Afficher les états</button>
                <button type="submit" class="btn btn-warning" {{ isset($user) ? '' : 'disabled' }}>
                    Valider nouvel état
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('showEtatsBtn').addEventListener('click', function () {
        document.getElementById('etatSelect').style.display = 'block';
        this.style.display = 'none'; // Cache le bouton après le clic
    });
</script>
@endsection
