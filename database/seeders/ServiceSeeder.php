<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $picturesPath = resource_path('pictures');
        $files = File::files($picturesPath);

        // Vytvoření složky services, pokud neexistuje
        if (!File::exists(storage_path('app/public/services'))) {
            File::makeDirectory(storage_path('app/public/services'), 0755, true);
        }

        // Kopírování obrázků z galerie do složky services
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $targetPath = storage_path('app/public/services/' . $filename);
            
            if (!File::exists($targetPath)) {
                File::copy($file->getPathname(), $targetPath);
            }
        }

        $services = [
            [
                'name' => 'Čalounění sedaček',
                'description' => 'Profesionální čalounění všech typů sedaček včetně rohových. Používáme kvalitní materiály a moderní techniky.',
                'price' => 3500,
                'image' => 'services/sedacka.png',
                'is_active' => true
            ],
            [
                'name' => 'Čalounění křesel',
                'description' => 'Kompletní čalounění křesel všech typů včetně relaxačních. Důraz klademe na pohodlí a trvanlivost.',
                'price' => 2500,
                'image' => 'services/kreslo.png',
                'is_active' => true
            ],
            [
                'name' => 'Čalounění židlí',
                'description' => 'Čalounění všech typů židlí včetně jídelních. Nabízíme široký výběr potahů a výplní.',
                'price' => 1200,
                'image' => 'services/zidle.png',
                'is_active' => true
            ],
            [
                'name' => 'Čalounění postelí',
                'description' => 'Specializované čalounění postelí včetně čel. Používáme kvalitní materiály pro maximální pohodlí.',
                'price' => 4000,
                'image' => 'services/postel.png',
                'is_active' => true
            ],
            [
                'name' => 'Výroba polštářů',
                'description' => 'Výroba polštářů na míru s možností výběru výplně a potahu. Vhodné pro postele i sedací nábytek.',
                'price' => 800,
                'image' => 'services/polstare.png',
                'is_active' => true
            ],
            [
                'name' => 'Výroba přehozů',
                'description' => 'Výroba přehozů na míru pro všechny typy nábytku. Nabízíme široký výběr látek a designů.',
                'price' => 1000,
                'image' => 'services/prehoz.png',
                'is_active' => true
            ],
            [
                'name' => 'Čalounění kůže',
                'description' => 'Specializované čalounění s použitím kvalitní kůže. Vhodné pro luxusní nábytek.',
                'price' => 4500,
                'image' => 'services/kuze.png',
                'is_active' => true
            ],
            [
                'name' => 'Oprava čalounění',
                'description' => 'Profesionální oprava poškozeného čalounění. Vracíme nábytku jeho původní vzhled.',
                'price' => 2000,
                'image' => 'services/oprava.png',
                'is_active' => true
            ],
            [
                'name' => 'Čištění čalounění',
                'description' => 'Profesionální čištění čalounění s použitím speciálních přípravků. Odstraňujeme skvrny a zápach.',
                'price' => 800,
                'image' => 'services/cisteni.png',
                'is_active' => true
            ],
            [
                'name' => 'Výměna molitanu',
                'description' => 'Výměna starého molitanu za nový s možností výběru tvrdosti. Prodlouží životnost nábytku.',
                'price' => 1200,
                'image' => 'services/molitan.png',
                'is_active' => true
            ]
        ];

        // Vytvoření služeb
        foreach ($services as $service) {
            Service::create($service);
        }
    }
} 