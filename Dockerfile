FROM php:8.2-apache

# Instalace závislostí a rozšíření
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Instalace Composeru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kopírování souborů do kontejneru
COPY . /var/www/html

# Pracovní složka
WORKDIR /var/www/html

# Laravel setup
RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate
