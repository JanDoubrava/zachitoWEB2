@extends('layouts.app')

@section('title', 'Služby')
@section('description', 'Nabízíme širokou škálu služeb v oblasti výroby nábytku na míru, čalounictví a renovace nábytku.')

@section('header')
    <div class="bg-primary py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 text-white mb-3">
                    Naše služby
                </h1>
                <p class="lead text-white">
                    Nabízíme kompletní služby v oblasti výroby nábytku na míru, čalounictví a renovace nábytku.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container py-5">
    {{-- Seznam služeb --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        {{-- Čalounění nábytku --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-house-door display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Čalounění nábytku</h3>
                    <p class="card-text">Profesionální čalounění nového i starého nábytku. Používáme kvalitní materiály a moderní techniky pro dokonalý výsledek.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Čalounění křesel a pohovky</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Obnovení čalounění židlí</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výměna potahů</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Renovace nábytku --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-tools display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Renovace nábytku</h3>
                    <p class="card-text">Kompletní renovace starého nábytku včetně opravy konstrukce, výměny čalounění a úpravy povrchů.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Oprava poškozených částí</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výměna výplní</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Úprava povrchů</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Výroba na míru --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-rulers display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Výroba na míru</h3>
                    <p class="card-text">Výroba čalouněného nábytku podle vašich představ a požadavků. Od návrhu až po realizaci.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Individuální návrhy</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výroba podle vzoru</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Realizace na míru</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Potahy a látky --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-scissors display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Potahy a látky</h3>
                    <p class="card-text">Široký výběr potahových látek a koženek. Pomůžeme vám vybrat vhodný materiál pro váš nábytek.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výběr materiálů</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Stříhání a šití</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Montáž potahů</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Opravy a údržba --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-wrench display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Opravy a údržba</h3>
                    <p class="card-text">Profesionální opravy a údržba čalouněného nábytku. Prodloužíme životnost vašeho nábytku.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Opravy poškození</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Údržba čalounění</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výměna výplní</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Konzultace --}}
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-chat-dots display-4"></i>
                    </div>
                    <h3 class="card-title h4 mb-3">Konzultace</h3>
                    <p class="card-text">Odborné poradenství při výběru materiálů, renovaci nebo výrobě nábytku na míru.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Návrhy řešení</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Výběr materiálů</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Rozpočty</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Kontaktní sekce --}}
    <div class="bg-primary bg-opacity-10 rounded-4 p-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="h3 mb-4">
                    Nenašli jste, co hledáte?
                </h2>
                <p class="lead mb-4">
                    Kontaktujte nás a my vám rádi pomůžeme s vaším projektem.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                    Kontaktujte nás
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 