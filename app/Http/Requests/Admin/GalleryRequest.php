<?php

namespace App\Http\Requests\Admin;

use App\Models\Gallery;
use Illuminate\Foundation\Http\FormRequest;

// Request třída pro validaci galerie v administraci
class GalleryRequest extends FormRequest
{
    /**
     * Určí, zda je uživatel oprávněn provést tento požadavek
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Pravidla validace
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'in:' . implode(',', array_keys(Gallery::CATEGORIES))],
            'is_active' => ['boolean']
        ];

        // Přidá validaci obrázku pouze při vytváření nebo když je nahrán nový
        if ($this->isMethod('post') || $this->hasFile('image')) {
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }

        return $rules;
    }

    /**
     * Vlastní chybové zprávy
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Název obrázku je povinný.',
            'title.max' => 'Název obrázku může mít maximálně 255 znaků.',
            'category.in' => 'Vybraná kategorie není platná.',
            'image.required' => 'Obrázek je povinný.',
            'image.image' => 'Soubor musí být obrázek.',
            'image.mimes' => 'Obrázek musí být ve formátu JPEG, PNG, JPG nebo GIF.',
            'image.max' => 'Obrázek může mít maximálně 2MB.'
        ];
    }
} 