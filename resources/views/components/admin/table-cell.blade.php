@props([
    'align' => 'left',
    'nowrap' => false
])

<td {{ $attributes->merge(['class' => 'px-6 py-4 ' . ($nowrap ? 'whitespace-nowrap ' : '') . 'text-sm text-gray-900 text-' . $align]) }}>
    {{ $slot }}
</td> 