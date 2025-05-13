<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aktualizace stavu objednávky</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a56db;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a56db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" height="50">
        <h1>Aktualizace stavu objednávky #{{ $order->id }}</h1>
    </div>

    <div class="content">
        <p>Dobrý den,</p>

        <p>stav Vaší objednávky byl změněn na: <strong>{{ $order->getStatusName() }}</strong></p>

        <h2>Detaily objednávky:</h2>
        <ul>
            @if($order->service)
                <li><strong>Služba:</strong> {{ $order->service->name }}</li>
            @endif
            <li><strong>Datum vytvoření:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</li>
            @if($order->admin_notes)
                <li><strong>Poznámka:</strong> {{ $order->admin_notes }}</li>
            @endif
        </ul>

        <div style="text-align: center;">
            <a href="{{ route('orders.show', $order) }}" class="button">
                Zobrazit detail objednávky
            </a>
        </div>

        <p>S pozdravem,<br>
        {{ config('app.name') }}</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Všechna práva vyhrazena.</p>
    </div>
</body>
</html> 