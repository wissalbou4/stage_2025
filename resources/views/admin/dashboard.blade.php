@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 py-3 border-bottom">
        <div>
            <h2 class="mb-1 fw-bold">Tableau de Bord Administrateur</h2>
            <p class="text-muted mb-0">
                <i class="fas fa-user-circle me-1"></i> 
                Bienvenue, <span class="fw-semibold text-primary">{{ $user->name }}</span> 
                <span class="badge bg-primary bg-opacity-10 text-primary ms-2">
                    <i class="fas fa-shield-alt me-1"></i>{{ $user->etat->etat }}
                </span>
            </p>
        </div>
        <div>
            <span class="badge bg-light text-dark fs-6 p-2">
                <i class="fas fa-calendar-day me-2"></i>{{ now()->format('d M Y, H:i') }}
            </span>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-chart-pie me-2"></i>Statistiques des Utilisateurs
            </h4>
            <div class="row g-4">
                <!-- Admin Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-primary border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-user-shield text-primary fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Admin</h6>
                                    <h2 class="mb-0 fw-bold">{{ $roleStats['admin'] ?? 0 }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-arrow-up me-1"></i> Gestion complète
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Operateur Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-user-cog text-success fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Opérateurs</h6>
                                    <h2 class="mb-0 fw-bold">{{ $roleStats['operateur'] ?? 0 }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-tasks me-1"></i> Gestion opérationnelle
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ramasseur Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-info border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-truck-pickup text-info fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Ramasseurs</h6>
                                    <h2 class="mb-0 fw-bold">{{ $roleStats['ramasseur'] ?? 0 }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-boxes me-1"></i> Collecte
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Controleur Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-warning border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-clipboard-check text-warning fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Contrôleurs</h6>
                                    <h2 class="mb-0 fw-bold">{{ $roleStats['controleur'] ?? 0 }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-search me-1"></i> Vérification
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Caissier Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-danger border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-cash-register text-danger fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Caissiers</h6>
                                    <h2 class="mb-0 fw-bold">{{ $roleStats['caissier'] ?? 0 }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="fas fa-money-bill-wave me-1"></i> Transactions
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Users Card -->
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="card border-start border-dark border-4 shadow-sm h-100 bg-dark text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-users text-white fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 mb-1">Total Utilisateurs</h6>
                                    <h2 class="mb-0 fw-bold">{{ array_sum($roleStats->toArray()) }}</h2>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-white bg-opacity-20 text-white">
                                    <i class="fas fa-database me-1"></i> Tous rôles
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .border-start {
        border-left-width: 4px !important;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush
@endsection
