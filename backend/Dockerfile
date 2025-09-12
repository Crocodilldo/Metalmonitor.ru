FROM php:8.2-fpm

# Устанавливаем зависимости и расширения
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Устанавливаем зависимости проекта (если есть composer.json)
RUN if [ -f "composer.json" ]; then composer install --no-interaction --prefer-dist --optimize-autoloader; fi

CMD ["php-fpm"]

