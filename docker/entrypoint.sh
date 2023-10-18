#!/bin/bash 
set -e

init() {
    cp .env.example .env
    php artisan key:generate
    composer install \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --no-dev \
        --prefer-dist

    composer dump-autoload --no-scripts
    php-fpm
}

init