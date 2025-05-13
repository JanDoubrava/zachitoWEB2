@component('mail::message')
# Zamítnutí objednávky

Vážený/á {{ $order->name }},

Omlouváme se, ale Vaše objednávka byla zamítnuta.

**Detaily objednávky:**

- Jméno: {{ $order->name }}
- Email: {{ $order->email }}
- Telefon: {{ $order->phone }}
- Adresa: {{ $order->address }}
- Zpráva: {{ $order->message }}

Pokud máte jakékoliv dotazy, neváhejte se na nás obrátit.

S pozdravem,<br>
{{ config('app.name') }}
@endcomponent 