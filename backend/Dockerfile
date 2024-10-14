# Use the official PHP image with FPM and Composer
FROM php:8.2-fpm

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev

# Install PHP extensions required for Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mbstring zip exif pcntl

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the existing Laravel application into the container
COPY . /var/www

# Set permissions for the storage and bootstrap cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-suggest

# Expose port 8000 to allow external access to Laravel app
EXPOSE 8000

# Run database migrations, seed the database, clear cache, and start the server
CMD php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan optimize:clear && \
    php artisan serve --host=0.0.0.0 --port=8000
