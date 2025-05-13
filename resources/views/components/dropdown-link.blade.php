{{-- Komponenta odkazu v rozbalovacím menu --}}
{{-- Odkaz s výchozím stylem pro položky v rozbalovacím menu a možností přizpůsobení pomocí předaných atributů --}}
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
