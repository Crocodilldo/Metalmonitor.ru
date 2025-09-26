FROM php:8.2-fpm

# Устанавливаем зависимости и расширения
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Добавляем wait-for-it.sh внутрь образа
COPY <<'EOF' /usr/local/bin/wait-for-it.sh
#!/usr/bin/env bash
HOST="$1"
PORT="$2"
shift 2
CMD="$@"

echo "Waiting for $HOST:$PORT..."
while ! (echo > /dev/tcp/$HOST/$PORT) >/dev/null 2>&1; do
  sleep 1
done
echo "$HOST:$PORT is available — starting command"
exec $CMD
EOF

RUN chmod +x /usr/local/bin/wait-for-it.sh


# Устанавливаем зависимости проекта (если есть composer.json)
RUN if [ -f "composer.json" ]; then \
        composer install --no-interaction --prefer-dist --optimize-autoloader && \
        composer require predis/predis --no-interaction; \
    fi
CMD ["php-fpm"]
