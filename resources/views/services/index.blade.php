@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Naše služby</h1>

    <div class="row g-4">
        @foreach($services as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $service->image)}}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h2 class="card-title h5">{{ $service->name }}</h2>
                    <p class="card-text">{{ $service->getShortDescription(150) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">{{ $service->getFormattedPrice() }}</span>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary">Objednat</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 