@extends('layouts.app')

@section('title', 'Detail objednávky - ZACHITO')

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
                <h1 class="h2">Detail objednávky #{{ $order->id }}</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-arrow-left me-2"></i>
                        Zpět na seznam
                    </a>
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

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-transparent">
                            <h5 class="card-title mb-0">Informace o objednávce</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID objednávky:</th>
                                    <td>#{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>Datum objednávky:</th>
                                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Čeká</option>
                                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Zpracovává se</option>
                                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Dokončeno</option>
                                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Zrušeno</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Služba:</th>
                                    <td>{{ $order->service->name }}</td>
                                </tr>
                                <tr>
                                    <th>Cena:</th>
                                    <td>{{ number_format($order->service->price, 0, ',', ' ') }} Kč</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-transparent">
                            <h5 class="card-title mb-0">Informace o zákazníkovi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Jméno:</th>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon:</th>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Adresa:</th>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <th>Poznámka:</th>
                                    <td>{{ $order->note ?: '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">Akce</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        @if($order->status === 'pending')
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="btn btn-info">
                                    <i class="bi bi-gear me-2"></i>
                                    Zpracovává se
                                </button>
                            </form>
                        @endif

                        @if($order->status === 'processing')
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Potvrdit dokončení
                                </button>
                            </form>
                        @endif

                        @if($order->status !== 'cancelled' && $order->status !== 'completed')
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Zrušit
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.orders.destroy', $order) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Opravdu chcete smazat tuto objednávku?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>
                                Smazat
                            </button>
                        </form>
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

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.1);
}

.table th {
    border-top: none;
    font-weight: 600;
    width: 40%;
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

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-color-dark);
    border-color: var(--primary-color-dark);
}
</style>
@endsection 