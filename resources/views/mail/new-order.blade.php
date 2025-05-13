@component('mail::message')
# Nová objednávka

Byla přijata nová objednávka od {{ $order->name }}.

**Detaily objednávky:**

- Jméno: {{ $order->name }}
- Email: {{ $order->email }}
- Telefon: {{ $order->phone }}
- Adresa: {{ $order->address }}
@if($order->message)
- Zpráva: {{ $order->message }}
@endif

@component('mail::button', ['url' => route('admin.orders.show', $order)])
Zobrazit detail objednávky
@endcomponent

Děkujeme,<br>
{{ config('app.name') }}
@endcomponent 