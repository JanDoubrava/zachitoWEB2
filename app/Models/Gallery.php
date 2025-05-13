<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

// Model pro správu galerie
class Gallery extends Model
{
    use HasFactory;

    // Název tabulky v databázi
    protected $table = 'gallery';

    // Pole, která lze hromadně naplnit
    protected $fillable = [
        'title',
        'description',
        'category',
        'image',
        'is_active'
    ];

    // Typování dat
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Dostupné kategorie
     */
    public const CATEGORIES = [
        'reference' => 'Reference',
        'prace' => 'Provedené práce'
    ];

    /**
     * Získá cestu k obrázku
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            Log::warning('Obrázek není nastaven', [
                'gallery_id' => $this->id
            ]);
            return null;
        }

        // Zkontrolujeme, zda obrázek existuje v storage složce
        if (!Storage::disk('public')->exists($this->image)) {
            Log::error('Obrázek neexistuje v storage složce', [
                'gallery_id' => $this->id,
                'image_path' => $this->image,
                'storage_path' => Storage::disk('public')->path($this->image)
            ]);
            return null;
        }

        // Vrátíme URL k obrázku pomocí Storage::url()
        $url = Storage::disk('public')->url($this->image);
        
        Log::info('Generování URL pro obrázek', [
            'gallery_id' => $this->id,
            'image_path' => $this->image,
            'url' => $url,
            'exists' => Storage::disk('public')->exists($this->image),
            'storage_path' => Storage::disk('public')->path($this->image)
        ]);

        return $url;
    }

    /**
     * Získá cestu k obrázku (pro zpětnou kompatibilitu)
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Získá název kategorie
     */
    public function getCategoryName(): string
    {
        return self::CATEGORIES[$this->category] ?? 'Nezařazeno';
    }

    /**
     * Získá zkrácený popis
     */
    public function getShortDescription(int $length = 100): string
    {
        return strlen($this->description) > $length 
            ? substr($this->description, 0, $length) . '...'
            : $this->description;
    }

    /**
     * Scope pro aktivní položky
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
} 