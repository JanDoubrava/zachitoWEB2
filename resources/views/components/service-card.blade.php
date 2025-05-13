@props(['service'])

<div class="bg-white rounded-lg shadow-sm overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
    <img src="{{ $service->getImageUrl() }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
        <p class="text-gray-600 mb-4">{{ $service->getShortDescription() }}</p>
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-900">{{ $service->getFormattedPrice() }}</span>
            <a href="{{ route('contact', ['service' => $service->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Objednat
            </a>
        </div>
    </div>
</div> 