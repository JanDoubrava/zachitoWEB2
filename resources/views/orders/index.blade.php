@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Moje objednávky')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Moje objednávky</h1>
                    </div>

                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-bag-x display-1 text-muted mb-3"></i>
                            <p class="lead text-muted">Zatím nemáte žádné objednávky.</p>
                            <a href="{{ route('orders.create') }}" class="btn btn-secondary mt-3">
                                Vytvořit novou objednávku
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Služba</th>
                                        <th>Cena</th>
                                        <th>Status</th>
                                        <th>Vytvořeno</th>
                                        <th>Akce</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($order->service->image)
                                                        <img src="{{ $order->service->getImageUrl() }}" alt="{{ $order->service->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <div class="fw-bold">{{ $order->service->name }}</div>
                                                        <div class="text-muted small">{{ Str::limit($order->service->description, 50) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($order->service->price, 0, ',', ' ') }} Kč</td>
                                            <td>
                                                <span class="badge {{ $order->getStatusClass() }}">
                                                    {{ $order->getStatusName() }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    color: var(--primary-color);
    border: none;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    border-radius: 0.25rem;
    transition: all 0.2s ease-in-out;
}

.pagination .page-link:hover {
    background-color: var(--primary-color);
    color: white;
}

.pagination .active .page-link {
    background-color: var(--primary-color);
    color: white;
}

.pagination .disabled .page-link {
    color: #6c757d;
    pointer-events: none;
}
</style>
@endsection 