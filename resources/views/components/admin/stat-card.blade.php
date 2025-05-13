@props([
    'title',
    'value',
    'description' => null,
    'icon' => null,
    'color' => 'blue'
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm overflow-hidden']) }}>
    <div class="p-6">
        <div class="flex items-center">
            @if($icon)
                <div @class([
                    'flex-shrink-0 rounded-full p-3 mr-4',
                    'bg-blue-100 text-blue-600' => $color === 'blue',
                    'bg-green-100 text-green-600' => $color === 'green',
                    'bg-yellow-100 text-yellow-600' => $color === 'yellow',
                    'bg-red-100 text-red-600' => $color === 'red',
                ])>
                    {{ $icon }}
                </div>
            @endif
            <div>
                <p class="text-sm font-medium text-gray-600">
                    {{ $title }}
                </p>
                <p class="mt-1 text-3xl font-semibold text-gray-900">
                    {{ $value }}
                </p>
                @if($description)
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $description }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div> 