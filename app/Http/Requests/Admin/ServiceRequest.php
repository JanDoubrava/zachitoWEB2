<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Request třída pro validaci služby v administraci
class ServiceRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string'],
            'features' => ['nullable', 'array'],
            'features.*' => ['string'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Vlastní chybové zprávy
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Název služby je povinný.',
            'name.max' => 'Název služby nemůže být delší než 255 znaků.',
            'description.required' => 'Popis služby je povinný.',
            'price.required' => 'Cena služby je povinná.',
            'price.numeric' => 'Cena musí být číslo.',
            'price.min' => 'Cena nemůže být záporná.',
            'image.required' => 'Obrázek služby je povinný při vytváření nové služby.',
            'image.image' => 'Soubor musí být obrázek.',
            'image.mimes' => 'Obrázek musí být ve formátu JPEG, PNG, JPG nebo GIF.',
            'image.max' => 'Obrázek nemůže být větší než 2MB.',
        ];
    }
} 