<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full rounded-lg shadow-md">
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                            <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                            <div class="mb-6">
                                <span class="text-2xl font-bold">{{ number_format($product->price, 0, ',', ' ') }} Kč</span>
                            </div>
                            <div class="mb-6">
                                <span class="text-sm text-gray-500">Kategorie: {{ $product->category->name }}</span>
                            </div>
                            @if($product->is_available)
                                <a href="{{ route('contact') }}" 
                                   class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 inline-block">
                                    Kontaktovat pro objednávku
                                </a>
                            @else
                                <span class="text-red-500">Produkt není momentálně dostupný</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 