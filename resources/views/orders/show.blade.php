@extends('layouts.app')

@section('title', 'Detail objednávky - ZACHITO')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail objednávky</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Zpět na seznam
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Číslo objednávky</h6>
                            <p class="mb-0">{{ $order->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Datum vytvoření</h6>
                            <p class="mb-0">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Jméno</h6>
                            <p class="mb-0">{{ $order->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Email</h6>
                            <p class="mb-0">{{ $order->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Telefon</h6>
                            <p class="mb-0">{{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <p class="mb-0">
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge bg-warning">Čeká na zpracování</span>
                                        @break
                                    @case('processing')
                                        <span class="badge bg-info">V procesu</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success">Dokončeno</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger">Zrušeno</span>
                                        @break
                                @endswitch
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Služba</h6>
                        <p class="mb-0">{{ $order->service->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Popis</h6>
                        <p class="mb-0">{{ $order->description }}</p>
                    </div>

                    @if($order->notes)
                        <div class="mb-4">
                            <h6 class="text-muted">Poznámky</h6>
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 