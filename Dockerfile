FROM node:24-alpine AS node-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM dunglas/frankenphp:1.4-php8.4-alpine

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    bcmath \
    gd \
    zip \
    intl \
    opcache \
    opentelemetry

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=node-build /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-scripts

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENV SERVER_NAME=":80"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
