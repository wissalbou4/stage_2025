<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Palette minimaliste */
            --primary-color: #4f46e5;    /* Indigo */
            --primary-light: #6366f1;   /* Indigo light */
            --primary-dark: #4338ca;     /* Indigo dark */
            --secondary-color: #10b981; /* Emerald */
            --accent-color: #f59e0b;    /* Amber */
            --danger-color: #ef4444;     /* Red */
            --light-color: #f9fafb;      /* Gray 50 */
            --light-gray: #e5e7eb;       /* Gray 200 */
            --dark-color: #111827;      /* Gray 900 */
            --text-muted: #6b7280;       /* Gray 500 */
            --text-color: #374151;       /* Gray 700 */
            --background-color: #ffffff; /* White */
            --card-bg: #ffffff;         /* White */
            
            --sidebar-width: 240px;
            --header-height: 64px;
            --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --transition: all 0.15s ease-in-out;
            --border-radius: 8px;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-wrapper {
            display: flex;
            flex: 1;
        }
        
        /* Navbar minimaliste */
        .navbar {
            height: var(--header-height);
            background-color: var(--background-color);
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--light-gray);
            padding: 0 1.5rem;
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--dark-color);
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        /* Sidebar minimaliste */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--background-color);
            border-right: 1px solid var(--light-gray);
            transition: var(--transition);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .sidebar-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }
        
        .sidebar .nav {
            padding: 0.75rem;
        }
        
        .nav-link {
            border-radius: var(--border-radius);
            margin: 0.25rem 0;
            padding: 0.75rem 1rem;
            color: var(--text-color);
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.925rem;
            display: flex;
            align-items: center;
        }
        
        .nav-link:hover {
            background-color: var(--light-gray);
            color: var(--primary-color);
        }
        
        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }
        
        .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            font-size: 1rem;
        }
        
        .nav-link.active i {
            color: white;
        }
        
        /* Contenu principal */
        .main-content {
            flex: 1;
            padding: 1.5rem;
            background-color: var(--light-color);
        }
        
        .content-wrapper {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--light-gray);
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .page-title {
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
            font-size: 1.5rem;
        }
        
        /* Boutons */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: var(--transition);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Tableaux */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin-bottom: 0;
            font-size: 0.875rem;
        }
        
        .table thead th {
            border-bottom: 1px solid var(--light-gray);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            background-color: var(--light-color);
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--light-gray);
            background-color: var(--card-bg);
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Cartes */
        .card {
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
            background-color: var(--card-bg);
        }
        
        .card-header {
            background-color: var(--light-color);
            border-bottom: 1px solid var(--light-gray);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        
        .badge.bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .badge.bg-success {
            background-color: var(--secondary-color) !important;
        }
        
        .badge.bg-warning {
            background-color: var(--accent-color) !important;
        }
        
        .badge.bg-danger {
            background-color: var(--danger-color) !important;
        }
        
        /* Dropdown utilisateur */
        .user-dropdown {
            display: flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .user-dropdown:hover {
            background-color: var(--light-gray);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 0.5rem;
        }
        
        .dropdown-menu {
            border: 1px solid var(--light-gray);
            box-shadow: var(--shadow-md);
            border-radius: var(--border-radius);
            padding: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: var(--transition);
        }
        
        .dropdown-item:hover {
            background-color: var(--light-gray);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                height: 100vh;
                margin-left: calc(-1 * var(--sidebar-width));
                box-shadow: var(--shadow-lg);
            }
            
            .sidebar.active {
                margin-left: 0;
            }
            
            .overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,0.3);
                z-index: 999;
                backdrop-filter: blur(2px);
            }
            
            .overlay.active {
                display: block;
            }
        }
        
        /* Footer */
        footer {
            background-color: var(--background-color);
            border-top: 1px solid var(--light-gray);
            padding: 1rem 0;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        
        footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Commandes spécifiques */
        .order-status {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .order-card {
            border-left: 4px solid var(--primary-color);
            transition: transform 0.2s;
        }
        
        .order-card:hover {
            transform: translateY(-2px);
        }
        
        .order-card .card-body {
            padding: 1rem;
        }
        
        .order-card .order-id {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .order-card .order-date {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        
        .order-card .order-total {
            font-weight: 600;
            margin-top: 0.5rem;
        }
        
        /* Formulaire de commande */
        .order-form .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }
        
        .order-form .form-control {
            border-radius: var(--border-radius);
            border: 1px solid var(--light-gray);
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .order-form .form-select {
            border-radius: var(--border-radius);
            border: 1px solid var(--light-gray);
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <button class="btn btn-sm d-lg-none me-2" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <a class="navbar-brand" href="/">
                <i class="fas fa-box-open"></i> Gestion Des Commandes
            </a>
            
            <div class="d-flex ms-auto">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-dropdown" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
                                <li><a class="dropdown-item" href="/settings"><i class="fas fa-cog me-2"></i> Paramètres</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        <!-- Overlay pour mobile -->
        <div class="overlay"></div>
        
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content -->
        <main class="main-content">
            <div class="container-fluid fade-in">
                @include('partials.alerts')
                
                <div class="content-wrapper">
                    <div class="page-header">
                        
                        @yield('page-actions')
                    </div>
                    
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div class="container">
            <div>
                &copy; {{ date('Y') }} {{ config('app.name') }} - Tous droits réservés
            </div>
            <div>
                <span class="text-muted">Version 1.0.0</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>