@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $service->name }}</h1>
            
            @if($service->image)
                <div class="mb-6">
                    <img src="{{ $service->getImageUrl() }}" 
                         alt="{{ $service->name }}" 
                         class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
            @endif
            
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Popis služby</h2>
                <p class="text-gray-600">{{ $service->description }}</p>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Cena</h2>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($service->price, 0, ',', ' ') }} Kč</p>
            </div>

            <div class="mt-8">
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Objednat službu
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 