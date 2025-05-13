@props([
    'headers' => [],
    'rows' => [],
    'actions' => false,
    'striped' => true,
    'hover' => true
])

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
                @if($actions)
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Akce</span>
                    </th>
                @endif
            </tr>
        </thead>
        <tbody @class([
            'bg-white divide-y divide-gray-200',
            'divide-y divide-gray-200' => $striped
        ])>
            {{ $slot }}
        </tbody>
    </table>
</div>

@once
    @push('styles')
        <style>
            .hover\:bg-gray-50:hover {
                background-color: rgba(249, 250, 251, var(--tw-bg-opacity));
            }
        </style>
    @endpush
@endonce 