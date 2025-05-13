<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Potvrzení objednávky</title>
</head>
<body>
    {{-- Hlavička emailu --}}
    <h1>Děkujeme za Vaši objednávku</h1>

    {{-- Informace o objednávce --}}
    <p>Vážený zákazníku,</p>
    <p>potvrzujeme přijetí Vaší objednávky č. {{ $order->id }}.</p>

    {{-- Detail objednávky --}}
    <h2>Detail objednávky:</h2>
    <p>
        <strong>Služba:</strong> {{ $order->service->name }}<br>
        <strong>Cena:</strong> {{ number_format($order->service->price, 0, ',', ' ') }} Kč<br>
        <strong>Datum objednávky:</strong> {{ $order->created_at->format('d.m.Y H:i') }}
    </p>

    {{-- Poznámka --}}
    @if($order->notes)
    <p><strong>Vaše poznámka:</strong> {{ $order->notes }}</p>
    @endif

    {{-- Patička emailu --}}
    <p>
        S pozdravem,<br>
        Tým ZACHITO
    </p>
</body>
</html> 