@component('mail::message')
# Potvrzení objednávky

Vážený/á {{ $order->name }},

Vaše objednávka byla úspěšně potvrzena.

**Detaily objednávky:**

- Jméno: {{ $order->name }}
- Email: {{ $order->email }}
- Telefon: {{ $order->phone }}
- Adresa: {{ $order->address }}
- Zpráva: {{ $order->message }}

Budeme Vás kontaktovat ohledně dalších kroků.

Děkujeme za Vaši důvěru,<br>
{{ config('app.name') }}
@endcomponent 