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
            <form action="{{ route('caissier.pointage.show') }}" method="GET" class="card p-3 mb-4">
                <h5>Recherche Commande</h5>
                <label>ID Commande :</label>
                <input type="number" name="commande_id" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">Entrer</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{ route('caissier.pointage.show') }}" method="GET" class="card p-3 mb-4">
                <h5>Recherche Utilisateur</h5>
                <label>ID Utilisateur :</label>
                <input type="number" name="user_id" class="form-control mb-2" required>
                <button type="submit" class="btn btn-secondary">Entrer</button>
            </form>
        </div>

        {{-- Formulaire de validation de pointage --}}
        <div class="col-md-6">
            <h5>Détails Commande</h5>
            <form action="{{ route('caissier.pointage.store') }}" method="POST">
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
                @if($commande)
                    <div class="mb-2">
                        <label>Code-barres :</label>
                        {!! DNS1D::getBarcodeHTML($commande->code_barre, 'C128', 2, 60) !!}
                        <p>{{ $commande->code_barre }}</p>
                    </div>
                @endif
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
                    <input type="text" class="form-control" value="{{ $user->etat->role ?? '' }}" readonly>
                </div>
                <div class="mb-2">État :
                    <input type="text" name="etat" class="form-control" value="{{ $user->etat->etat ?? '' }}">
                </div>
                @if($user)
                    <div class="mb-2">
                        <label for="code_barre">Code-barres :</label>
                        {!! DNS1D::getBarcodeHTML($user->code_barre, 'C128', 2, 60) !!}
                        <p>{{ $user->code_barre }}</p>
                    </div>
                @endif
            </form>
            @if(session('etat_update'))
                <div class="mt-4">
                    <h2><strong>{{ session('etat_update') }}</strong></h2>
                </div>
            @endif
        </div>

        {{-- Formulaire de changement d’état --}}
        <div class="card p-3 mb-4">
            <h5>Changer l’état de l’utilisateur</h5>
            <form action="{{ route('caissier.pointage.user.update_etat') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
                <input type="hidden" name="commande_id" value="{{ $commande->id ?? '' }}">

                <div class="mb-2">
                    @php
                        $etats = \App\Models\Etat::all();
                    @endphp
                    <label>Nouvel état :</label>
                    <select id="etatSelect" name="etat_id" class="form-control">
                        <option value="">-- Choisir un état --</option>
                        @foreach($etats as $etat)
                            <option value="{{ $etat->id }}" {{ isset($user) && $user->etat_id == $etat->id ? 'selected' : '' }}>
                                {{ $etat->etat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center mt-4">
                    <button type="submit"
                        class="btn btn-success btn-lg w-100 py-3 fs-4"
                        style="max-width: 400px;"
                        {{ isset($user) ? '' : 'disabled' }}>
                        Valider le nouvel état
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            // Réinitialiser tous les champs input sauf les boutons et hidden
            document.querySelectorAll('input.form-control').forEach(input => {
                if (input.type !== 'hidden') input.value = '';
            });

            // Réinitialiser le select
            const select = document.getElementById('etatSelect');
            if (select) {
                select.selectedIndex = 0;
            }

            // Supprimer les codes-barres
            document.querySelectorAll('form p').forEach(p => p.innerText = '');
            document.querySelectorAll('form svg').forEach(svg => svg.remove());
        @endif
    });
</script>
@endsection
