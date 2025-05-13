<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nová zpráva z kontaktního formuláře</title>
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
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #1a56db;
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
        <h1>Nová zpráva z kontaktního formuláře</h1>
    </div>

    <div class="content">
        <div class="field">
            <span class="label">Jméno:</span>
            <p>{{ $data['name'] }}</p>
        </div>

        <div class="field">
            <span class="label">Email:</span>
            <p>{{ $data['email'] }}</p>
        </div>

        <div class="field">
            <span class="label">Telefon:</span>
            <p>{{ $data['phone'] }}</p>
        </div>

        @if(isset($data['address']) && $data['address'])
        <div class="field">
            <span class="label">Adresa:</span>
            <p>{{ $data['address'] }}</p>
        </div>
        @endif

        <div class="field">
            <span class="label">Zpráva:</span>
            <p>{{ $data['message'] }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Tato zpráva byla automaticky vygenerována z kontaktního formuláře na webu.</p>
        <p>&copy; {{ date('Y') }} JAN DOUBRAVA. Všechna práva vyhrazena.</p>
    </div>
</body>
</html> 