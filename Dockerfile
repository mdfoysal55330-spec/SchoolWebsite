FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev \
    libxml2-dev libzip-dev libicu-dev gnupg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

COPY . /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD bash -c "php artisan storage:link --force; php artisan migrate --force --seed; php artisan config:clear; php artisan cache:clear; sed -i \"s/Listen 80/Listen $PORT/\" /etc/apache2/ports.conf; sed -i \"s/:80/:$PORT/\" /etc/apache2/sites-available/000-default.conf; apache2-foreground"
