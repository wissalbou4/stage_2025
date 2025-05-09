<aside class="sidebar">
            <div class="sidebar-header">
                <h5><i class="fas fa-list-ul me-2"></i>Dashboard</h5>
            </div>
            
            <ul class="nav flex-column">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" 
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li> 
                     <!-- Gestion Utilisateurs -->
                     <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/users*') ? 'bg-primary' : '' }}" 
                            href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users-cog me-3"></i>Gestion Utilisateurs
                        </a>
                    </li> 
     
                    <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/clients*') ? 'active' : '' }}"
                    href="{{ route('admin.clients.index') }}">
                        <i class="fas fa-users me-2"></i>Liste-Clients
                    </a>

                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/commandes*') ? 'active' : '' }}"
                    href="{{ route('admin.commandes.index') }}">
                        <i class="fas fa-users me-2"></i>Liste-Commandes
                    </a>
                    </li>

                    @endif
                    @if(auth()->user()->hasRole('operateur'))

                    <li class="nav-item">
                    <a class="nav-link {{ Request::is('operateur/clients*') ? 'active' : '' }}"
                    href="{{ route('operateur.clients.index') }}">
                        <i class="fas fa-users me-2"></i> Clients
                    </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('operateur/commandes*') ? 'active' : '' }}" href="{{ route('operateur.commandes.index') }}">
                            <i class="fas fa-shopping-cart"></i> Commandes
                        </a>
                    </li>
                    
                    
                    @endif
                

                @if(auth()->user()->hasRole('ramasseur'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('ramasseur/commandes*') ? 'active' : '' }}" href="{{ route('ramasseur.commandes.index') }}">
                            <i class="fas fa-shopping-cart"></i> Commandes
                        </a>
                    </li>


                @endif

                @if(auth()->user()->hasRole('controleur'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('controleur/commandes*') ? 'active' : '' }}" href="{{ route('controleur.commandes.index') }}">
                            <i class="fas fa-shopping-cart"></i> Commandes
                        </a>
                    </li>


                @endif

                @if(auth()->user()->hasRole('caissier'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('caissier/commandes*') ? 'active' : '' }}" href="{{ route('caissier.commandes.index') }}">
                            <i class="fas fa-shopping-cart"></i> Commandes
                        </a>
                    </li>


                @endif
                @endauth

                
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/features">
                        <i class="fas fa-star"></i> Fonctionnalités
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pricing">
                        <i class="fas fa-tag"></i> Tarifs
                    </a>
                </li>
                @endguest
            </ul>
        </aside>