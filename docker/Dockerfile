FROM php:8.2-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache curl zip unzip \
    libpng-dev \ 
    libzip-dev	\
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    icu-dev \
    freetype-dev

RUN IPE_GD_WITHOUTAVIF=1 docker-php-ext-install -j$(nproc) gd pdo_mysql bcmath mysqli opcache zip intl \
    && docker-php-source delete

# RUN addgroup -S www \
#     && adduser -S -D www -h /home/www -s /bin/bash -G www \
#     && addgroup www root \
#     && addgroup www www-data 

# RUN mkdir -p /home/www/.composer && chown -R www:www /home/www

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www

CMD entrypoint.sh
# USER www