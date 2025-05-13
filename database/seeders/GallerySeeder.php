<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = [
            [
                'title' => 'Čalounění taburetů',
                'description' => 'Profesionální čalounění taburetů všech typů a velikostí.',
                'category' => 'reference',
                'image' => 'taburet.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění sedaček Comfort',
                'description' => 'Kompletní čalounění sedaček Comfort s důrazem na pohodlí.',
                'category' => 'reference',
                'image' => 'sedacka-comfort.png',
                'is_active' => true
            ],
            [
                'title' => 'Oprava čalounění',
                'description' => 'Oprava poškozeného čalounění nábytku.',
                'category' => 'prace',
                'image' => 'sada-oprava.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění rohových sedaček',
                'description' => 'Specializované čalounění rohových sedaček.',
                'category' => 'reference',
                'image' => 'rohova-sedacka.png',
                'is_active' => true
            ],
            [
                'title' => 'Výroba přehozů',
                'description' => 'Výroba kvalitních přehozů na míru.',
                'category' => 'prace',
                'image' => 'prehoz.png',
                'is_active' => true
            ],
            [
                'title' => 'Potahy židlí',
                'description' => 'Výroba a montáž potahů na židle.',
                'category' => 'reference',
                'image' => 'potah-zidle.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění postelí Royal',
                'description' => 'Luxusní čalounění postelí Royal.',
                'category' => 'reference',
                'image' => 'postel-royal.png',
                'is_active' => true
            ],
            [
                'title' => 'Výroba polštářů',
                'description' => 'Výroba polštářů na míru.',
                'category' => 'prace',
                'image' => 'polstare.png',
                'is_active' => true
            ],
            [
                'title' => 'Odstraňování skvrn',
                'description' => 'Profesionální odstraňování skvrn z čalounění.',
                'category' => 'prace',
                'image' => 'odstranovat-skvrn.png',
                'is_active' => true
            ],
            [
                'title' => 'Výměna molitanu',
                'description' => 'Výměna starého molitanu za nový.',
                'category' => 'prace',
                'image' => 'molitan.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění předsíňových lavic',
                'description' => 'Čalounění předsíňových lavic.',
                'category' => 'reference',
                'image' => 'lavice-predsien.png',
                'is_active' => true
            ],
            [
                'title' => 'Premium látky',
                'description' => 'Čalounění s prémiovými látkami.',
                'category' => 'reference',
                'image' => 'latka-premium.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění kůže',
                'description' => 'Specializované čalounění s kůží.',
                'category' => 'reference',
                'image' => 'kuze.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění relaxačních křesel',
                'description' => 'Čalounění relaxačních křesel.',
                'category' => 'reference',
                'image' => 'kreslo-relax.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění koženky',
                'description' => 'Čalounění s koženkou.',
                'category' => 'reference',
                'image' => 'kozenka.png',
                'is_active' => true
            ],
            [
                'title' => 'Kartáčování čalounění',
                'description' => 'Profesionální kartáčování čalounění.',
                'category' => 'prace',
                'image' => 'kartac.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění jídelních židlí',
                'description' => 'Čalounění jídelních židlí.',
                'category' => 'reference',
                'image' => 'jidelni-zidle.png',
                'is_active' => true
            ],
            [
                'title' => 'Čištění čalounění',
                'description' => 'Profesionální čištění čalounění.',
                'category' => 'prace',
                'image' => 'cistic.png',
                'is_active' => true
            ],
            [
                'title' => 'Čalounění čel postelí',
                'description' => 'Čalounění čel postelí.',
                'category' => 'reference',
                'image' => 'celo-postele.png',
                'is_active' => true
            ]
        ];

        // Vytvoření složky gallery, pokud neexistuje
        if (!File::exists(storage_path('app/public/gallery'))) {
            File::makeDirectory(storage_path('app/public/gallery'), 0755, true);
        }

        // Kopírování obrázků do složky gallery
        $picturesPath = resource_path('pictures');
        $files = File::files($picturesPath);

        foreach ($files as $index => $file) {
            if (isset($galleryItems[$index])) {
                $filename = $file->getFilename();
                $targetPath = storage_path('app/public/gallery/' . $filename);
                
                if (!File::exists($targetPath)) {
                    File::copy($file->getPathname(), $targetPath);
                }
                
                // Aktualizace cesty k obrázku v databázi
                $galleryItems[$index]['image'] = 'gallery/' . $filename;
            }
        }

        foreach ($galleryItems as $item) {
            Gallery::create($item);
        }
    }

    /**
     * Převede název souboru na čitelný titulek
     */
    private function getTitleFromFilename(string $filename): string
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $name = str_replace(['-', '_'], ' ', $name);
        return ucfirst($name);
    }

    /**
     * Určí kategorii podle názvu souboru
     */
    private function getCategoryFromFilename(string $filename): string
    {
        $name = strtolower(pathinfo($filename, PATHINFO_FILENAME));
        
        if (str_contains($name, 'reference') || str_contains($name, 'ukazka')) {
            return 'reference';
        }
        
        return 'prace';
    }
} 