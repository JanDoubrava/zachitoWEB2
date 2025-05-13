<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

// Request třída pro validaci kontaktního formuláře
class AdminContactRequest extends FormRequest
{
    /**
     * Určuje, zda je uživatel autorizován provést tento požadavek.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Vrací validační pravidla pro formulář.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9+ ]{9,}$/', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
            'gdpr' => ['required', 'accepted'],
        ];
    }

    /**
     * Vrací vlastní validační zprávy.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Prosím vyplňte své jméno.',
            'name.min' => 'Jméno musí mít alespoň :min znaky.',
            'email.required' => 'Prosím vyplňte svůj email.',
            'email.email' => 'Zadejte prosím platnou emailovou adresu.',
            'email.dns' => 'Zadaná emailová doména neexistuje.',
            'phone.required' => 'Prosím vyplňte své telefonní číslo.',
            'phone.regex' => 'Zadejte prosím platné telefonní číslo.',
            'message.required' => 'Prosím vyplňte zprávu.',
            'message.min' => 'Zpráva musí mít alespoň :min znaků.',
            'gdpr.required' => 'Pro odeslání formuláře je nutný souhlas se zpracováním osobních údajů.',
            'gdpr.accepted' => 'Pro odeslání formuláře je nutný souhlas se zpracováním osobních údajů.',
        ];
    }
} 