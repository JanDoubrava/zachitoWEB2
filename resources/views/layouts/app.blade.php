<!DOCTYPE html>
<html lang="cs">
    <head>
        {{-- Meta tagy --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ asset('storage/gallery/postel-royal.png') }}">

        {{-- Titulek stránky --}}
        <title>@yield('title', 'ZACHITO - Čalounění a renovace nábytku')</title>
        <meta name="description" content="@yield('description', 'Profesionální čalounění a renovace nábytku. Více než 20 let zkušeností.')">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Bootstrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        {{-- Styly --}}
        <style>
            :root {
                --primary-color: #2C3E50;    /* Tmavě modrošedá pro hlavní barvu */
                --secondary-color: #C0392B;   /* Tmavě červená pro sekundární barvu */
                --accent-color: #E67E22;      /* Oranžová pro akcenty */
                --text-color: #2D3748;        /* Tmavě šedá pro text */
                --light-color: #ECF0F1;       /* Světle šedá pro pozadí */
                --hover-color: #34495E;       /* Tmavší modrošedá pro hover efekty */
                --white: #FFFFFF;
                --border-color: #BDC3C7;      /* Světle šedá pro ohraničení */
                --footer-text: #95A5A6;       /* Světle šedá pro text v patičce */
            }
            
            body {
                background-color: var(--light-color);
                color: var(--text-color);
                font-size: 1rem;
                line-height: 1.6;
            }
            
            .navbar {
                background-color: var(--primary-color) !important;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
            }
            
            .navbar-brand {
                font-weight: 600;
                color: var(--white) !important;
            }
            
            .nav-link {
                color: var(--white) !important;
                font-weight: 500;
                transition: all 0.3s ease;
            }
            
            .nav-link:hover {
                color: var(--accent-color) !important;
            }
            
            .nav-link.active {
                color: var(--accent-color) !important;
            }
            
            .btn-primary {
                background-color: var(--accent-color);
                border-color: var(--accent-color);
                color: var(--white);
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background-color: var(--hover-color);
                border-color: var(--hover-color);
                transform: translateY(-2px);
            }

            .btn-primary .bi {
                color: var(--white) !important;
            }
            
            .btn-outline-primary {
                color: var(--accent-color);
                border-color: var(--accent-color);
                transition: all 0.3s ease;
            }
            
            .btn-outline-primary:hover {
                background-color: var(--accent-color);
                border-color: var(--accent-color);
                color: var(--white);
                transform: translateY(-2px);
            }
            
            .card {
                border: none;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
                transition: all 0.3s ease;
                background-color: var(--white);
            }
            
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0,0,0,.2);
            }
            
            footer {
                background-color: var(--primary-color) !important;
            }

            .btn-more-info {
                background-color: var(--accent-color) !important;
                border-color: var(--accent-color) !important;
                color: var(--white) !important;
                font-weight: 500;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-size: 0.9rem;
            }

            .btn-more-info:hover {
                background-color: var(--hover-color) !important;
                border-color: var(--hover-color) !important;
                color: var(--white) !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,.2);
            }

            .btn-more-info i {
                margin-left: 0.5rem;
                transition: transform 0.3s ease;
            }

            .btn-more-info:hover i {
                transform: translateX(3px);
            }

            .dropdown-menu {
                border: none;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
                background-color: var(--white);
            }

            .dropdown-item {
                color: var(--text-color);
                transition: all 0.3s ease;
            }

            .dropdown-item:hover {
                background-color: var(--light-color);
                color: var(--secondary-color);
            }

            .alert {
                border: none;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
            }

            .alert-success {
                background-color: #27AE60;
                color: var(--white);
            }

            .alert-danger {
                background-color: var(--secondary-color);
                color: var(--white);
            }

            .text-light {
                color: var(--white) !important;
            }

            .bg-accent {
                background-color: var(--accent-color) !important;
            }

            .social-links a {
                color: var(--white) !important;
                transition: color 0.3s ease;
            }

            .social-links a:hover {
                color: var(--accent-color) !important;
            }

            /* Formuláře */
            .form-control {
                border: 1px solid var(--border-color);
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
            }
            
            .form-control:focus {
                border-color: var(--accent-color);
                box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
            }
            
            .form-label {
                color: var(--text-color);
                font-weight: 500;
                margin-bottom: 0.5rem;
            }
            
            .form-text {
                color: var(--footer-text);
                font-size: 0.875rem;
            }
            
            /* Patička */
            footer {
                background-color: var(--primary-color) !important;
                color: var(--footer-text);
            }
            
            footer h5 {
                color: var(--white);
                font-weight: 600;
                margin-bottom: 1.25rem;
            }
            
            footer p {
                margin-bottom: 0.5rem;
            }
            
            footer i {
                color: var(--accent-color);
                margin-right: 0.5rem;
                width: 1.25rem;
            }
            
            footer hr {
                border-color: rgba(255, 255, 255, 0.1);
            }
            
            /* Texty */
            h1, h2, h3, h4, h5, h6 {
                color: var(--text-color);
                font-weight: 600;
                margin-bottom: 1rem;
            }
            
            h1 { font-size: 2.5rem; }
            h2 { font-size: 2rem; }
            h3 { font-size: 1.75rem; }
            h4 { font-size: 1.5rem; }
            h5 { font-size: 1.25rem; }
            h6 { font-size: 1rem; }
            
            p {
                margin-bottom: 1rem;
            }
            
            /* Tabulky */
            .table {
                background-color: var(--white);
                border-radius: 0.5rem;
                overflow: hidden;
            }
            
            .table th {
                background-color: var(--light-color);
                color: var(--text-color);
                font-weight: 600;
                border-bottom: 2px solid var(--border-color);
            }
            
            .table td {
                border-color: var(--border-color);
            }
            
            /* Karty */
            .card {
                border: none;
                border-radius: 0.75rem;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
                transition: all 0.3s ease;
                background-color: var(--white);
                overflow: hidden;
            }
            
            .card-header {
                background-color: var(--light-color);
                border-bottom: 1px solid var(--border-color);
                padding: 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .card-footer {
                background-color: var(--light-color);
                border-top: 1px solid var(--border-color);
                padding: 1rem;
            }
            
            /* Tlačítka v patičce */
            footer .btn-link {
                color: var(--footer-text);
                text-decoration: none;
                transition: color 0.3s ease;
            }
            
            footer .btn-link:hover {
                color: var(--accent-color);
            }
            
            /* Sociální ikony v patičce */
            .social-links a {
                color: var(--footer-text) !important;
                font-size: 1.25rem;
                transition: all 0.3s ease;
            }
            
            .social-links a:hover {
                color: var(--accent-color) !important;
                transform: translateY(-2px);
            }
            
            /* Copyright text */
            footer .text-center p {
                color: var(--footer-text);
                font-size: 0.875rem;
                margin-bottom: 0;
            }

            /* Zaškrtávací ikonky v seznamu */
            .feature-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .feature-list li {
                position: relative;
                padding-left: 2rem;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
            }

            .feature-list li::before {
                content: '';
                position: absolute;
                left: 0;
                width: 24px;
                height: 24px;
                background-color: var(--accent-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--white);
                font-family: "Bootstrap Icons";
                content: "\F26B";
                font-size: 1rem;
            }

            .feature-list li strong {
                display: block;
                color: var(--text-color);
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .feature-list li p {
                color: var(--footer-text);
                margin: 0;
                font-size: 0.9rem;
            }

            /* Obrázky v sekci O nás */
            .about-image {
                border-radius: 1rem;
                box-shadow: 0 4px 8px rgba(0,0,0,.1);
                transition: all 0.3s ease;
                overflow: hidden;
                position: relative;
                background-color: var(--white);
            }

            .about-image:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0,0,0,.2);
            }

            .about-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .about-image:hover img {
                transform: scale(1.05);
            }

            .about-image::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.2) 100%);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .about-image:hover::after {
                opacity: 1;
            }

            .about-image-caption {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 1rem;
                background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
                color: var(--white);
                transform: translateY(100%);
                transition: transform 0.3s ease;
            }

            .about-image:hover .about-image-caption {
                transform: translateY(0);
            }

            /* Ikony v sekci O nás */
            .feature-icon {
                width: 64px;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background-color: var(--light-color);
                margin-bottom: 1rem;
                transition: all 0.3s ease;
            }

            .feature-icon i {
                font-size: 1.5rem;
                color: var(--accent-color);
            }

            .feature:hover .feature-icon {
                background-color: var(--accent-color);
                transform: translateY(-5px);
            }

            .feature:hover .feature-icon i {
                color: var(--white);
            }

            /* Obrázky v galerii */
            .gallery-image {
                border-radius: 0.5rem;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
                transition: all 0.3s ease;
                overflow: hidden;
                background-color: var(--white);
            }

            .gallery-image:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 8px rgba(0,0,0,.2);
            }

            .gallery-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .gallery-image:hover img {
                transform: scale(1.05);
            }

            /* Zaškrtávací ikonky v sekci O nás */
            .bi-check-circle-fill {
                color: var(--accent-color) !important;
                font-size: 1.25rem;
                background-color: var(--light-color);
                border-radius: 50%;
                padding: 0.25rem;
                width: 2rem;
                height: 2rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 0.25rem !important;
            }

            /* Velké ikony v kartách */
            .card .bi:not(.btn-primary .bi) {
                color: var(--accent-color) !important;
            }
        </style>

        {{-- Custom CSS --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <header>
            @auth
                @include('layouts.navigation')
            @else
                <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="ZACHITO Logo" height="40" class="me-2">
                            ZACHITO
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
                            </ul>
                            <div class="d-flex">
                                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    Přihlásit se
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                                    <i class="bi bi-person-plus me-1"></i>
                                    Registrovat se
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            @endauth
        </header>

        <main class="container py-4 mt-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-white mb-4">Kontakt</h5>
                        <p class="text-white-50 mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            Ulice 123, Město
                        </p>
                        <p class="text-white-50 mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            +420 123 456 789
                        </p>
                        <p class="text-white-50">
                            <i class="bi bi-envelope me-2"></i>
                            info@zachito.cz
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h5>Otevřeno</h5>
                        <p>
                            Po - Pá: 8:00 - 17:00<br>
                            So: 9:00 - 12:00<br>
                            Ne: Zavřeno
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h5>Sledujte nás</h5>
                        <div class="social-links">
                            <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-light"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} JAN DOUBRAVA. Všechna práva vyhrazena.</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
