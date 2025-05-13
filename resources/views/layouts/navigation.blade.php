{{-- Hlavní navigační lišta --}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="ZACHITO" height="40" class="me-2">
            <span class="fw-bold">ZACHITO</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Domů
                        <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('home') ? 'w-100' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        O nás
                        <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('about') ? 'w-100' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('services.index') ? 'active' : '' }}" href="{{ route('services.index') }}">
                        Služby
                        <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('services.index') ? 'w-100' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">
                        Galerie
                        <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('gallery') ? 'w-100' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">
                        Objednat
                        <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('orders.create') ? 'w-100' : '' }}"></span>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link position-relative {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                            Moje objednávky
                            <span class="position-absolute bottom-0 start-50 translate-middle-x w-0 h-2 bg-accent rounded-pill transition-all duration-300 {{ request()->routeIs('orders.index') ? 'w-100' : '' }}"></span>
                        </a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-link text-light text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if(Auth::user()->isAdmin())
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-gear me-2"></i>
                                        Administrace
                                    </a>
                                </li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Odhlásit se
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Přihlásit se
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-person-plus me-1"></i>
                            Registrovat se
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
