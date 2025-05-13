{{-- Komponenta modálního okna --}}
{{-- Kontejner pro modální okno s možností přizpůsobení pomocí předaných atributů --}}
@props(['id' => null, 'maxWidth' => null, 'title' => '', 'content' => '', 'footer' => ''])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-6 text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
