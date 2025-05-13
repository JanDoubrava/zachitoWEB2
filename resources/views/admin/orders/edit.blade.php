@extends('layouts.app')

@section('title', 'Upravit objednávku - ZACHITO')

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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Upravit objednávku #{{ $order->id }}</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form method="POST" action="{{ route('admin.logout') }}">
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

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Informace o objednávce -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Informace o zákazníkovi</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Jméno:</strong> {{ $order->name }}</p>
                                    <p><strong>Email:</strong> {{ $order->email }}</p>
                                    <p><strong>Telefon:</strong> {{ $order->phone }}</p>
                                    <p><strong>Adresa:</strong> {{ $order->address }}</p>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Stav objednávky</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Stav</label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" name="status" required>
                                                <option value="{{ \App\Models\Order::STATUS_PENDING }}" {{ $order->status === \App\Models\Order::STATUS_PENDING ? 'selected' : '' }}>
                                                    Čeká na zpracování
                                                </option>
                                                <option value="{{ \App\Models\Order::STATUS_PROCESSING }}" {{ $order->status === \App\Models\Order::STATUS_PROCESSING ? 'selected' : '' }}>
                                                    V procesu
                                                </option>
                                                <option value="{{ \App\Models\Order::STATUS_COMPLETED }}" {{ $order->status === \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>
                                                    Dokončeno
                                                </option>
                                                <option value="{{ \App\Models\Order::STATUS_CANCELLED }}" {{ $order->status === \App\Models\Order::STATUS_CANCELLED ? 'selected' : '' }}>
                                                    Zrušeno
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-lg me-2"></i>
                                            Aktualizovat stav
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Detaily objednávky -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Detaily objednávky</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Služba:</strong> {{ $order->service->name }}</p>
                                    <p><strong>Stav:</strong> 
                                        @if($order->status === \App\Models\Order::STATUS_PENDING)
                                            <span class="badge bg-warning">Čeká na zpracování</span>
                                        @elseif($order->status === \App\Models\Order::STATUS_PROCESSING)
                                            <span class="badge bg-info">V procesu</span>
                                        @elseif($order->status === \App\Models\Order::STATUS_COMPLETED)
                                            <span class="badge bg-success">Dokončeno</span>
                                        @else
                                            <span class="badge bg-danger">Zrušeno</span>
                                        @endif
                                    </p>
                                    <p><strong>Vytvořeno:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Zpráva zákazníka</h5>
                                </div>
                                <div class="card-body">
                                    {{ $order->message }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Akce -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Akce</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between gap-2">
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Opravdu chcete smazat tuto objednávku?')">
                                                    <i class="bi bi-trash"></i> Smazat
                                                </button>
                                            </form>
                                        </div>

                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-cart me-2"></i>
                                            Zpět na seznam objednávek
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

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

.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.25);
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: #fff;
}
</style>
@endsection 