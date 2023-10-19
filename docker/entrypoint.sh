#!/bin/sh
set -e

init() {
    if [ ! -f ".env" ]; then
        cp .env.example .env
        php artisan key:generate
    fi

    if [ ! -f "vendor/autoload.php" ]; then
        composer install \
            --no-interaction \
            --no-plugins \
            --no-scripts \
            --no-dev \
            --prefer-dist
        
        composer dump-autoload --no-scripts
        
        find . -type f -exec chmod 644 {} \;
        find . -type d -exec chmod 775 {} \;
        chown -R www-data:root ./ 
        chmod -R 777 storage
        chmod -R 777 bootstrap/cache/
    fi
}

init
php-fpm