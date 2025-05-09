<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            width: 100%;
            max-width: 380px; /* Taille moyenne */
            margin: 0 auto;
            padding: 1.75rem; /* Padding légèrement réduit */
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            background-color: white;
        }
        
        .form-floating {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #6c757d;
            z-index: 10;
        }
        
        .form-floating input {
            padding-left: 2.5rem !important;
            height: 48px; /* Hauteur moyenne */
        }
        
        .form-floating > label {
            padding-left: 2.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
            font-weight: 500;
            padding: 0.5rem 0.75rem; /* Taille moyenne */
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }
        
        .login-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.25rem 0;
        }
        
        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .login-divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        
        .social-btn {
            width: 42px; /* Taille moyenne */
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0e0e0;
            background-color: white;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .logo {
            font-size: 1.75rem; /* Taille moyenne */
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .alert {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
        
        h2 {
            font-size: 1.5rem; /* Taille moyenne */
        }
        
        p.text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="text-center mb-3">
                <div class="logo">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h2 class="fw-bold">Connexion</h2>
                <p class="text-muted">Accédez à votre espace personnel</p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    @foreach ($errors->all() as $error)
                        <p class="mb-1">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3 position-relative">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" class="form-control" id="email" name="email" 
                           placeholder="name@example.com" required>
                    <label for="email">Adresse email</label>
                </div>
                
                <div class="form-floating mb-3 position-relative">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Mot de passe" required>
                    <label for="password">Mot de passe</label>
                </div>
                
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="#" class="text-decoration-none">Mot de passe oublié?</a>
                </div>
                
                <div class="d-grid mb-3">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                    </button>
                </div>
            </form>
            
    
            
            <div class="text-center">
                <p class="mb-0">Pas encore de compte? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">S'inscrire</a></p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
