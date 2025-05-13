@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center my-5">
        <img src="{{ asset('images/logo.png') }}" alt="Zachito logo" class="img-fluid mb-4" style="max-width: 200px;">
        <h1 class="display-1 fw-bold">Zachito</h1>
        <div class="hero-image my-5">
            <img src="{{ asset('images/hero_image.jpg') }}" alt="Luxusní čalouněné čelo postele" class="img-fluid rounded shadow-lg" style="max-width: 1000px; width: 100%;">
        </div>
        <p class="lead">
            Vítejte v našem světě luxusního čalounění a renovace nábytku
        </p>
    </div>
    
    <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
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
        
        <div class="carousel-inner rounded shadow">
            <div class="carousel-item active">
                <img src="{{ asset('images/sedacka.jpg') }}" class="d-block w-100" alt="Sedačka">
                <div class="carousel-caption">
                    <h5>Luxusní sedačka</h5>
                    <p>Maximální pohodlí pro váš domov</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/kreslo.jpg') }}" class="d-block w-100" alt="Křeslo">
                <div class="carousel-caption">
                    <h5>Křeslo</h5>
                    <p>Perfektní pro odpočinek</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/zidle.jpg') }}" class="d-block w-100" alt="Židle">
                <div class="carousel-caption">
                    <h5>Židle</h5>
                    <p>Elegantní design pro váš interiér</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/postel.jpg') }}" class="d-block w-100" alt="Postel">
                <div class="carousel-caption">
                    <h5>Postel</h5>
                    <p>Královský komfort pro váš spánek</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/postel2.jpg') }}" class="d-block w-100" alt="Postel">
                <div class="carousel-caption">
                    <h5>Postel</h5>
                    <p>Elegantní řešení pro váš spánek</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/polstar.jpg') }}" class="d-block w-100" alt="Polštář">
                <div class="carousel-caption">
                    <h5>Polštář</h5>
                    <p>Měkkost a podpora pro dokonalý spánek</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/polstar2.jpg') }}" class="d-block w-100" alt="Polštář">
                <div class="carousel-caption">
                    <h5>Polštář</h5>
                    <p>Elegantní doplněk vaší ložnice</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/prehoz.jpg') }}" class="d-block w-100" alt="Přehoz">
                <div class="carousel-caption">
                    <h5>Přehoz</h5>
                    <p>Stylový doplněk pro váš interiér</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/kuze.jpg') }}" class="d-block w-100" alt="Kůže">
                <div class="carousel-caption">
                    <h5>Kůže</h5>
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
@endsection 