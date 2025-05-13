@props([
    'title' => '',
    'footer' => null,
    'padding' => true,
    'header' => null
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm overflow-hidden']) }}>
    @if($header)
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            {{ $header }}
        </div>
    @elseif($title)
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div @class([
        'px-6 py-4' => $padding
    ])>
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $footer }}
        </div>
    @endif
</div> 