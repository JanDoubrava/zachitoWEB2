@extends('layouts.app')

@section('title', 'Správa objednávek - ZACHITO')

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
                <h1 class="h2">Správa objednávek</h1>
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jméno</th>
                                    <th>Email</th>
                                    <th>Služba</th>
                                    <th>Status</th>
                                    <th>Datum</th>
                                    <th>Akce</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->service->name }}</td>
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
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.orders.show', $order) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.orders.edit', $order) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.orders.destroy', $order) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Opravdu chcete smazat tuto objednávku?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Žádné objednávky nebyly nalezeny.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $orders->links('vendor.pagination.bootstrap-5') }}
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

.table th {
    border-top: none;
    font-weight: 600;
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

/* Styly pro stránkování */
.pagination {
    margin-bottom: 0;
    justify-content: center;
}

.page-link {
    color: var(--primary-color);
    border: none;
    margin: 0 2px;
    border-radius: 4px;
    padding: 8px 16px;
    transition: all 0.3s;
}

.page-link:hover {
    background-color: var(--primary-color);
    color: #fff;
}

.page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: #fff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border: none;
}
</style>
@endsection 