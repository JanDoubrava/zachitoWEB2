<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .navbar {
            background-color: #1e2a4a;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
        }

        .navbar-brand img {
            height: 30px;
            margin-right: 0.5rem;
        }

        .sidebar {
            background-color: #1e2a4a;
            min-height: 100vh;
            padding: 1rem;
        }

        .sidebar .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .logo-container img {
            height: 60px;
            margin-bottom: 0.5rem;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.7);
            padding: 0.5rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,.1);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,.2);
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 1.5rem;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
        }

        .btn-outline-light {
            color: white;
            border-color: rgba(255,255,255,.5);
        }

        .btn-outline-light:hover {
            background-color: rgba(255,255,255,.1);
            border-color: white;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="ZACHITO">
                ZACHITO
            </a>
            <div class="d-flex">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-house-door me-2"></i>
                    Domů
                </a>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-tools me-2"></i>
                    Služby
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-images me-2"></i>
                    Galerie
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-cart me-2"></i>
                    Objednávky
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-people me-2"></i>
                    Uživatelé
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Odhlásit se
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="ZACHITO">
                    <h6 class="text-white">Administrace</h6>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" 
                           href="{{ route('admin.services.index') }}">
                            <i class="bi bi-tools me-2"></i>
                            Služby
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                           href="{{ route('admin.orders.index') }}">
                            <i class="bi bi-cart me-2"></i>
                            Objednávky
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" 
                           href="{{ route('admin.gallery.index') }}">
                            <i class="bi bi-images me-2"></i>
                            Galerie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i>
                            Uživatelé
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.password.edit') ? 'active' : '' }}" 
                           href="{{ route('admin.password.edit') }}">
                            <i class="bi bi-person me-2"></i>
                            Profil
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2">@yield('title')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('actions')
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline ms-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Odhlásit se
                            </button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 