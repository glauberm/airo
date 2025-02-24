FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        curl \
        unzip \
        git \
        nano \
    && rm -rf \
        /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    intl \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure PHP for development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Configure opcache for development
RUN echo "opcache.revalidate_freq = 0" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.validate_timestamps = 1" >> "$PHP_INI_DIR/conf.d/opcache.ini"

# Copy the current directory contents into the container
COPY . /var/www/html/api

# Create nginx user
RUN useradd -ms /bin/bash nginx
RUN chown -R nginx:nginx /var/www/html/api

# Set working directory
WORKDIR /var/www/html/api
