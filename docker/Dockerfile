FROM php:8.2-fpm-alpine

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install system dependencies
RUN apk add --no-cache curl zip unzip \
    libpng-dev \ 
    libzip-dev	\
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    icu-dev \
    freetype-dev

RUN IPE_GD_WITHOUTAVIF=1 docker-php-ext-install -j$(nproc) pdo_mysql bcmath mysqli opcache zip intl\
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-source delete

# Create system user to run Composer and Artisan Commands

RUN addgroup -S edusms \
    && adduser -S -D edusms -h /home/edusms -s /bin/bash -G edusms \
    && addgroup edusms root \
    && addgroup edusms www-data 

RUN mkdir -p /home/edusms/.composer && chown -R edusms:edusms /home/edusms

# Set working directory
WORKDIR /var/www
USER edusms
