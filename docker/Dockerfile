FROM php:8.2-fpm-alpine

ENV IPE_GD_WITHOUTAVIF=1

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

RUN docker-php-ext-install -j$(nproc) pdo_mysql bcmath mysqli opcache zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype  intl \
    && docker-php-ext-install -j$(nproc) gd intl \
    && docker-php-source delete

# Create system user to run Composer and Artisan Commands
RUN adduser -u 1000 -G www-data -D edusms
# RUN mkdir -p /home/edusms/.composer && chown -R edusms:edusms /home/edusms

# Set working directory
WORKDIR /var/www

USER edusms