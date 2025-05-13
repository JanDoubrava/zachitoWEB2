@extends('layouts.app')

@section('title', 'Úvod')
@section('description', 'Čalounictví ZACHITO - profesionální výroba a renovace nábytku s tradicí od roku 2000.')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-0">
        <!-- Hero sekce -->
        <div class="position-relative bg-dark" style="height: 600px;">
            <div class="position-absolute top-0 start-0 w-100 h-100">
                <img class="w-100 h-100 object-fit-cover" src="{{ asset('images/hero_image.jpg') }}" alt="Čalounické práce">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>
            </div>
            <div class="position-relative container h-100 d-flex flex-column justify-content-center">
                <h1 class="display-1 fw-bold text-white">ZACHITO</h1>
                <p class="lead text-white-50 mt-4" style="max-width: 600px;">
                    Profesionální čalounické práce všeho druhu. Vytvoříme pro vás pohodlný a estetický interiér.
                </p>
                <div class="mt-4">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">
                        Objednat službu
                    </a>
                </div>
            </div>
        </div>

        {{-- Posuvná galerie --}}
        <div class="bg-light py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Naše práce</h2>
                    <p class="lead text-muted">Prohlédněte si ukázky našich realizací</p>
                </div>

                <div id="homeCarousel" class="carousel slide carousel-fade rounded-4 shadow-lg overflow-hidden mb-4" data-bs-ride="carousel">
                    <style>
                        #homeCarousel {
                            position: relative;
                            border-radius: 1rem !important;
                        }
                        .carousel-inner {
                            border-radius: 1rem;
                            overflow: hidden;
                        }
                        #homeCarousel::before {
                            content: '';
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            right: 0;
                            height: 40%;
                            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
                            z-index: 1;
                            pointer-events: none;
                        }
                        .carousel-caption {
                            background: rgba(0, 0, 0, 0.85);
                            border-radius: 15px;
                            padding: 25px;
                            max-width: 90%;
                            margin: 0 auto;
                            bottom: 3rem;
                            z-index: 2;
                            border: 2px solid rgba(255, 255, 255, 0.1);
                        }
                        .carousel-caption h3 {
                            font-size: 2.5rem;
                            font-weight: 800;
                            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
                            margin-bottom: 1rem;
                            color: var(--accent-color);
                        }
                        .carousel-caption p {
                            font-size: 1.4rem;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
                            color: #ffffff;
                            font-weight: 500;
                        }
                        .carousel-control-prev,
                        .carousel-control-next {
                            width: 10%;
                            opacity: 0.7;
                            z-index: 3;
                            transition: opacity 0.3s ease;
                        }
                        .carousel-control-prev:hover,
                        .carousel-control-next:hover {
                            opacity: 1;
                        }
                        .carousel-control-prev-icon,
                        .carousel-control-next-icon {
                            width: 3rem;
                            height: 3rem;
                            background-color: rgba(0, 0, 0, 0.5);
                            border-radius: 50%;
                            background-size: 50%;
                            transition: background-color 0.3s ease;
                        }
                        .carousel-control-prev:hover .carousel-control-prev-icon,
                        .carousel-control-next:hover .carousel-control-next-icon {
                            background-color: var(--accent-color);
                        }
                        .carousel-indicators {
                            margin-bottom: 1.5rem;
                            z-index: 3;
                        }
                        .carousel-indicators button {
                            width: 12px;
                            height: 12px;
                            border-radius: 50%;
                            margin: 0 6px;
                            background-color: rgba(255, 255, 255, 0.5);
                            border: 2px solid transparent;
                            transition: all 0.3s ease;
                            position: relative;
                        }
                        .carousel-indicators button::after {
                            content: '';
                            position: absolute;
                            top: -4px;
                            left: -4px;
                            right: -4px;
                            bottom: -4px;
                            border: 2px solid transparent;
                            border-radius: 50%;
                            transition: all 0.3s ease;
                        }
                        .carousel-indicators button.active {
                            background-color: var(--accent-color);
                            transform: scale(1.2);
                        }
                        .carousel-indicators button.active::after {
                            border-color: rgba(255, 255, 255, 0.5);
                        }
                        .carousel-item img {
                            filter: brightness(0.9);
                        }
                    </style>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="3"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="4"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="5"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="6"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="7"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="8"></button>
                    </div>
                    
                    <div class="carousel-inner rounded-4 shadow">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/sedacka.jpg') }}" class="d-block w-100" alt="Sedačka" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Luxusní sedačka</h3>
                                <p>Maximální pohodlí pro váš domov</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/kreslo.jpg') }}" class="d-block w-100" alt="Křeslo" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Křeslo</h3>
                                <p>Perfektní pro odpočinek</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/zidle.jpg') }}" class="d-block w-100" alt="Židle" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Židle</h3>
                                <p>Elegantní design pro váš interiér</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/postel.jpg') }}" class="d-block w-100" alt="Postel" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Postel</h3>
                                <p>Královský spánek v luxusním provedení</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/postel2.jpg') }}" class="d-block w-100" alt="Postel" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Postel</h3>
                                <p>Elegantní řešení pro váš spánek</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/polstar.jpg') }}" class="d-block w-100" alt="Polštář" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Polštář</h3>
                                <p>Měkkost a podpora pro dokonalý spánek</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/polstar2.jpg') }}" class="d-block w-100" alt="Polštář" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Polštář</h3>
                                <p>Elegantní doplněk vaší ložnice</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/prehoz.jpg') }}" class="d-block w-100" alt="Přehoz" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Přehoz</h3>
                                <p>Stylový doplněk pro váš interiér</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/kuze.jpg') }}" class="d-block w-100" alt="Kůže" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption">
                                <h3>Kůže</h3>
                                <p>Kvalitní materiál pro dlouhou životnost</p>
                            </div>
                        </div>
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Předchozí</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Další</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Sekce služeb --}}
        <div class="bg-white py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Naše služby</h2>
                    <p class="lead text-muted">Kompletní služby v oblasti čalounění a renovace nábytku</p>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach($services->take(8) as $service)
                        <div class="col">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ $service->getImageUrl() }}" 
                                         alt="{{ $service->name }}" 
                                         class="card-img-top"
                                         style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text">{{ $service->short_description }}</p>
                                    <p class="card-text"><strong>{{ number_format($service->price, 0, ',', ' ') }} Kč</strong></p>
                                    <a href="{{ route('services.index') }}" class="btn btn-primary">
                                        Více informací
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Smooth scroll pro odkazy
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Automatické přepínání carouselu
    const carousel = new bootstrap.Carousel(document.querySelector('#homeCarousel'), {
        interval: 5000,
        touch: true
    });
</script>
@endpush
