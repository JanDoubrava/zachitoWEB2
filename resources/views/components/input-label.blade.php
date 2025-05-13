{{-- Komponenta popisku formulářového pole --}}
{{-- Label element s možností přizpůsobení pomocí předaných atributů --}}
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
