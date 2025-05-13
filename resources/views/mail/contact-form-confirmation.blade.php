<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Potvrzení přijetí vaší zprávy</title>
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
        <h1>Potvrzení přijetí vaší zprávy</h1>
    </div>

    <div class="content">
        <p>Vážený/á {{ $name }},</p>

        <p>děkujeme za vaši zprávu. Tímto potvrzujeme její přijetí.</p>

        <p>Budeme se snažit odpovědět co nejdříve, nejpozději do 2 pracovních dnů.</p>

        <p>S přátelským pozdravem,<br>
        Tým ZACHITO</p>
    </div>

    <div class="footer">
        <p>Toto je automaticky generovaná zpráva, prosím neodpovídejte na ni.</p>
        <p>&copy; {{ date('Y') }} JAN DOUBRAVA. Všechna práva vyhrazena.</p>
    </div>
</body>
</html> 