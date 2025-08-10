# Stage 1: Build assets
FROM node:20 AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP + Apache
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd \
    && a2enmod rewrite

WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel code
COPY . .

# Copy build assets dari stage node
COPY --from=node-builder /app/public/build ./public/build

RUN composer install --optimize-autoloader --no-dev \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
