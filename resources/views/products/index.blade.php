<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">
                            @if(isset($currentCategory))
                                {{ $currentCategory->name }}
                            @else
                                Všechny produkty
                            @endif
                        </h1>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold">{{ number_format($product->price, 0, ',', ' ') }} Kč</span>
                                        <a href="{{ route('products.show', $product) }}" 
                                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 