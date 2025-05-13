@props([
    'hover' => true
])

<tr {{ $attributes->merge(['class' => $hover ? 'hover:bg-gray-50' : '']) }}>
    {{ $slot }}
</tr> 