# ZACHITO - Administrační systém

Systém pro správu webových stránek ZACHITO, včetně správy služeb, galerie, objednávek a uživatelů.

## Požadavky

- PHP 8.1 nebo vyšší
- MySQL 5.7 nebo vyšší
- Composer
- Node.js a npm (pro kompilaci assetů)

## Instalace

1. Naklonujte repozitář:
```bash
git clone https://github.com/your-username/zachito.git
cd zachito
```

2. Nainstalujte závislosti:
```bash
composer install
npm install
```

3. Zkopírujte `.env.example` do `.env`:
```bash
cp .env.example .env
```

4. Vygenerujte aplikační klíč:
```bash
php artisan key:generate
```

5. Nastavte databázi v `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zachito
DB_USERNAME=root
DB_PASSWORD=
```

6. Spusťte migrace a seedy:
```bash
php artisan migrate --seed
```

7. Zkompilujte assety:
```bash
npm run dev
```

## Výchozí přihlašovací údaje

- Email: admin@zachito.cz
- Heslo: admin123

## Struktura projektu

```
zachito/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/         # Controllery pro administraci
│   │   └── Middleware/        # Middleware pro kontrolu oprávnění
│   └── Models/               # Eloquent modely
├── resources/
│   └── views/
│       └── admin/            # Šablony pro administraci
└── routes/
    └── web.php              # Webové routy
```

## Bezpečnostní funkce

- Rate limiting pro přihlášení
- CSRF ochrana
- Validace vstupů
- Logování důležitých akcí
- Kontrola oprávnění pomocí middleware

## Vývoj

1. Vytvořte novou branch:
```bash
git checkout -b feature/nazev-funkce
```

2. Commitněte změny:
```bash
git commit -am 'Přidána nová funkce'
```

3. Pushněte do repozitáře:
```bash
git push origin feature/nazev-funkce
```

## Testování

Spusťte testy pomocí:
```bash
php artisan test
```

## Licence

Tento projekt je licencován pod MIT licencí.
