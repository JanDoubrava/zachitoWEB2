@props(['level' => 'primary'])

@php
$color = match ($level) {
    'success' => 'green',
    'error' => 'red',
    'warning' => 'yellow',
    default => 'blue',
};
@endphp

<div {{ $attributes->merge(['class' => 'bg-white p-6 rounded-lg shadow-sm']) }}>
    {{ $slot }}
</div> 