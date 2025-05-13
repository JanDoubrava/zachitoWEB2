<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

// Model pro správu služeb
class Service extends Model
{
    use HasFactory;

    // Pole, která lze hromadně naplnit
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'features',
        'image',
        'is_active'
    ];

    // Typování dat
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Validační pravidla pro službu
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'nullable|string',
        'duration' => 'nullable|string',
        'features' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_active' => 'boolean'
    ];

    /**
     * Získá název služby
     */
    public function getTitleAttribute()
    {
        return $this->name;
    }

    /**
     * Nastaví název služby
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    /**
     * Scope pro aktivní služby
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Vztah k objednávkám
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Formátuje cenu pro zobrazení
     */
    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' Kč';
    }

    /**
     * Získá cestu k obrázku
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgZmlsbD0iI2VlZWVlZSIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IiM5OTk5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5OZW5í IG9icmF6ZWs8L3RleHQ+PC9zdmc+';
        }

        // Zkontrolujeme, zda obrázek existuje v storage složce
        if (!Storage::disk('public')->exists($this->image)) {
            Log::error('Obrázek služby neexistuje v storage složce', [
                'image_path' => $this->image
            ]);
            return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgZmlsbD0iI2VlZWVlZSIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IiM5OTk5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5OZW7DrSBvYnJhemVrPC90ZXh0Pjwvc3ZnPg==';
        }

        // Vrátíme absolutní URL obrázku služby
        $url = config('app.url') . '/storage/' . $this->image;
        Log::info('Generování URL obrázku služby', [
            'image_path' => $this->image,
            'url' => $url
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
     * Získá zkrácený popis
     */
    public function getShortDescription(int $length = 100): string
    {
        return strlen($this->description) > $length 
            ? substr($this->description, 0, $length) . '...'
            : $this->description;
    }
} 