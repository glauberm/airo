FROM php:8.4-fpm

ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 22.14.0

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

# Install NVM
RUN mkdir -p $NVM_DIR && \
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash && \
    . $NVM_DIR/nvm.sh && \
    nvm install $NODE_VERSION && \
    nvm alias default $NODE_VERSION

# Configure PHP for development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Configure opcache for development
RUN echo "opcache.revalidate_freq = 0" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.validate_timestamps = 1" >> "$PHP_INI_DIR/conf.d/opcache.ini"

# Create nginx user
RUN useradd -ms /bin/bash nginx
RUN chown -R nginx:nginx /var/www/html

# Switch to nginx user
USER nginx

# Add NVM directory to nginx user
ENV NVM_DIR /usr/local/nvm
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

# Copy the current directory contents into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html
