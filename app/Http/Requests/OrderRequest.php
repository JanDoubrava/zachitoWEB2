<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'message' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Jméno je povinné',
            'name.max' => 'Jméno může mít maximálně 255 znaků',
            'email.required' => 'E-mail je povinný',
            'email.email' => 'Zadejte platnou e-mailovou adresu',
            'email.max' => 'E-mail může mít maximálně 255 znaků',
            'phone.required' => 'Telefon je povinný',
            'phone.max' => 'Telefon může mít maximálně 20 znaků',
            'address.required' => 'Adresa je povinná',
            'message.required' => 'Zpráva je povinná',
            'service_id.exists' => 'Vybraná služba neexistuje',
        ];
    }
} 