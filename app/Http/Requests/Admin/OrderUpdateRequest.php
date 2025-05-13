<?php

namespace App\Http\Requests\Admin;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

// Request třída pro validaci aktualizace objednávky v administraci
class OrderUpdateRequest extends FormRequest
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
            'status' => ['required', 'string', 'in:' . implode(',', [
                Order::STATUS_PENDING,
                Order::STATUS_COMPLETED,
                Order::STATUS_CANCELLED
            ])],
            'admin_notes' => ['nullable', 'string', 'max:1000']
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
            'status.required' => 'Stav objednávky je povinný.',
            'status.in' => 'Neplatný stav objednávky.',
            'admin_notes.max' => 'Poznámka může mít maximálně 1000 znaků.'
        ];
    }
} 