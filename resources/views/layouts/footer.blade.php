{{-- Patička webu --}}
<footer class="bg-white shadow mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- O nás --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">O nás</h3>
                <p class="text-gray-600">
                    Poskytujeme profesionální služby v oblasti péče o vlasy a krásu.
                </p>
            </div>

            {{-- Kontaktní informace --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontakt</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>Email: info@zachito.cz</li>
                    <li>Telefon: +420 123 456 789</li>
                    <li>Adresa: Náměstí Republiky 1, Praha 1</li>
                </ul>
            </div>

            {{-- Odkazy --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Rychlé odkazy</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Domů</a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-900">Služby</a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}" class="text-gray-600 hover:text-gray-900">Galerie</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="mt-8 pt-8 border-t border-gray-200 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} JAN DOUBRAVA. Všechna práva vyhrazena.</p>
        </div>
    </div>
</footer> 