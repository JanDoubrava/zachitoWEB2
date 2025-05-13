@props(['item'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <a href="{{ route('gallery.show', $item) }}" class="block">
        <img src="{{ $item->image_url }}" 
             alt="{{ $item->title }}" 
             class="w-full h-48 object-cover">
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-2">{{ $item->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $item->getShortDescription() }}</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">{{ $item->getCategoryName() }}</span>
                <span class="text-blue-500 hover:text-blue-600">Zobrazit detail</span>
            </div>
        </div>
    </a>
</div> 