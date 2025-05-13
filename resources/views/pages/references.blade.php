@extends('layouts.app')

@section('title', 'Reference')
@section('description', 'Podívejte se na naše realizace a reference od spokojených zákazníků.')

@section('header')
    <div class="bg-primary py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 text-white mb-3">Reference</h1>
                <p class="lead text-white">Podívejte se na naše realizace</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container py-5">
    <div class="row g-4">
        @foreach($gallery as $item)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="{{ $item->image_url }}" 
                         class="card-img-top" 
                         alt="{{ $item->title }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title h5 mb-2">{{ $item->title }}</h3>
                        @if($item->description)
                            <p class="card-text small">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $gallery->links() }}
    </div>
</div>
@endsection 