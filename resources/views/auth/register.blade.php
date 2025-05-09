<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm border-0 rounded-2">
                    <div class="card-body p-3">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-plus-fill text-primary fs-3"></i>
                            <h5 class="fw-bold mt-2 mb-1">Inscription</h5>
                            <p class="text-muted small">Créez votre compte</p>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger py-2 px-3 mb-2 small">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register') }}" class="small">
                            @csrf
                            
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required>
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <select class="form-select form-select-sm" id="etat_id" name="etat_id" required>
                                        @foreach(App\Models\Etat::all() as $etat)
                                            <option value="{{ $etat->id }}">{{ $etat->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-person-check me-1"></i>S'inscrire
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-2">
                            <p class="mb-0 small">Déjà un compte? <a href="{{ route('login') }}" class="text-decoration-none">Se connecter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
