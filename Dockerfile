# Stage 1: Node build for frontend assets
FROM node:18-alpine as node-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Composer build for PHP dependencies (use PHP image, not composer image)
FROM php:8.2-fpm-alpine as composer-build
WORKDIR /app

# Install PHP extensions needed for composer install
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    icu-dev \
    zlib-dev \
    libzip-dev \
    libxml2-dev \
    oniguruma-dev \
    bash \
    unzip \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring gd xml zip intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .
RUN composer install --no-dev --optimize-autoloader

# Stage 3: Production image
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Install PHP extensions and system dependencies
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    icu-dev \
    zlib-dev \
    libzip-dev \
    libxml2-dev \
    oniguruma-dev \
    bash \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring gd xml zip intl

COPY --from=composer-build /app ./
COPY --from=node-build /app/public ./public
COPY --from=node-build /app/public/dist ./public/dist
COPY --from=node-build /app/public/build ./public/build

RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8000