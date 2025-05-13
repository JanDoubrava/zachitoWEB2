{{-- Rozšíření hlavního layoutu --}}
@extends('layouts.app')

{{-- Titulek stránky --}}
@section('title', 'O nás')
@section('description', 'Poznejte firmu ZACHITO s.r.o. - specialistu na čalounické práce a renovace nábytku.')

{{-- Hlavní obsah --}}
@section('header')
    <div class="bg-primary py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 text-white mb-3">O nás</h1>
                <p class="lead text-white">ZACHITO s.r.o. - Váš specialista na čalounické práce a renovace nábytku</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <h2 class="h3 mb-4">Naše historie</h2>
            <p class="lead">
                Firma ZACHITO s.r.o. byla založena v roce 2010 s cílem poskytovat profesionální čalounické služby nejvyšší kvality. 
                Za více než desetiletí působení na trhu jsme získali bohaté zkušenosti a spokojené zákazníky po celé České republice.
            </p>
        </div>

        <div class="col-lg-6">
            <h2 class="h3 mb-4">Naše hodnoty</h2>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-start">
                    <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                    <div>
                        <h3 class="h5 mb-1">Kvalita</h3>
                        <p class="mb-0">Používáme pouze prvotřídní materiály a moderní technologie</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                    <div>
                        <h3 class="h5 mb-1">Profesionalita</h3>
                        <p class="mb-0">Náš tým tvoří zkušení odborníci s dlouholetou praxí</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                    <div>
                        <h3 class="h5 mb-1">Spokojenost</h3>
                        <p class="mb-0">Vaše spokojenost je naší prioritou</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="h3 mb-4">Proč si vybrat nás?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-award display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Zkušenosti</h3>
                        <p class="card-text mb-0">
                            Více než 10 let zkušeností v oboru čalounictví a renovací nábytku.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-tools display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Komplexní služby</h3>
                        <p class="card-text mb-0">
                            Od drobných oprav až po kompletní renovace a zakázkovou výrobu.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-shield-check display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Záruka kvality</h3>
                        <p class="card-text mb-0">
                            Na všechny naše práce poskytujeme záruku a garantujeme spokojenost.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="h3 mb-4">Kontaktní informace</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-geo-alt display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Adresa</h3>
                        <p class="card-text mb-0">
                            ZACHITO s.r.o.<br>
                            Ulice 123<br>
                            123 45 Město
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-telephone display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Kontakt</h3>
                        <p class="card-text mb-0">
                            Tel: +420 123 456 789<br>
                            Email: info@zachito.cz<br>
                            IČO: 12345678
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="bi bi-clock display-4"></i>
                        </div>
                        <h3 class="h5 mb-3">Otevírací doba</h3>
                        <p class="card-text mb-0">
                            Po - Pá: 8:00 - 17:00<br>
                            So: 9:00 - 12:00<br>
                            Ne: Zavřeno
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
