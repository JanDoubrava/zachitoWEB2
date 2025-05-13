@extends('layouts.app')

@section('title', 'Nová služba - ZACHITO')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: var(--primary-color);">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="ZACHITO Logo" height="40" class="mb-2">
                    <h6 class="text-white">Administrace</h6>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" 
                           href="{{ route('admin.services.index') }}">
                            <i class="bi bi-tools me-2"></i>
                            Služby
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                           href="{{ route('admin.orders.index') }}">
                            <i class="bi bi-cart me-2"></i>
                            Objednávky
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" 
                           href="{{ route('admin.gallery.index') }}">
                            <i class="bi bi-images me-2"></i>
                            Galerie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i>
                            Uživatelé
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.password.edit') ? 'active' : '' }}" 
                           href="{{ route('admin.password.edit') }}">
                            <i class="bi bi-person me-2"></i>
                            Profil
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Main content --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h2>Nová služba</h2>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Zpět na seznam
                </a>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Název služby *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Popis *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Cena *</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Obrázek</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Doba realizace</label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration') }}">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="features" class="form-label">Vlastnosti služby</label>
                            <textarea class="form-control @error('features') is-invalid @enderror" 
                                      id="features" name="features" rows="4">{{ old('features') }}</textarea>
                            <div class="form-text">Každou vlastnost zadejte na nový řádek</div>
                            @error('features')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Aktivní služba</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" onclick="prepareForm(event)">
                                <i class="bi bi-check-lg me-2"></i>
                                Vytvořit službu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function formatPrice(input) {
    // Odstraníme všechny nečíselné znaky kromě tečky
    let value = input.value.replace(/[^\d.]/g, '');
    
    // Převedeme na číslo
    let number = parseFloat(value);
    
    // Formátujeme s mezerami pro lepší čitelnost
    if (!isNaN(number)) {
        input.value = number.toLocaleString('cs-CZ', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
}

function prepareForm(event) {
    event.preventDefault();
    
    // Získáme hodnotu ceny a odstraníme mezery
    const priceInput = document.getElementById('price');
    if (priceInput.value) {
        priceInput.value = priceInput.value.replace(/\s/g, '');
    }
    
    // Odešleme formulář
    event.target.form.submit();
}
</script>

<style>
.sidebar {
    min-height: 100vh;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
}

.sidebar .nav-link {
    padding: 0.5rem 1rem;
    color: rgba(255,255,255,.8);
    transition: all 0.3s;
}

.sidebar .nav-link:hover {
    color: #fff;
    background: rgba(255,255,255,.1);
}

.sidebar .nav-link.active {
    color: #fff;
    background: rgba(255,255,255,.2);
}

.card {
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.form-check-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
}
</style>
@endsection 