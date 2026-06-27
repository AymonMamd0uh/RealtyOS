FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libonig-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        intl \
        zip \
        bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN php artisan storage:link || true

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=$PORT