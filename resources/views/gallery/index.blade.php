@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Galerie realizací</h1>

    <div class="row g-4">
        @foreach($items as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h2 class="card-title h5">{{ $item->title }}</h2>
                    <p class="card-text">{{ $item->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $items->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
