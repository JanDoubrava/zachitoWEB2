{{-- Komponenta pro zobrazení chybových zpráv --}}
{{-- Seznam chybových zpráv s možností přizpůsobení pomocí předaných atributů --}}
@props(['messages'])

@if ($messages)
    {{-- Seznam chybových zpráv --}}
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
