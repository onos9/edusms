ARG ALPINE_VERSION=3.16
FROM alpine:${ALPINE_VERSION}
LABEL Maintainer="Onojeta Brown <onosbrown.save@gmail.com>"
LABEL Description="Lightweight container with Nginx 1.22 & PHP 8.1 based on Alpine Linux."

# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apk add --no-cache \
  ca-certificates \
  curl \
  nginx \
  php81 \
  nano \
  # php81-xdebug \
  php81-pdo \
  php81-pdo_mysql \
  php81-json \
  php81-bcmath \
  php81-ctype \
  php81-curl \
  php81-dom \
  php81-fpm \
  php81-gd \
  php81-intl \
  php81-mbstring \
  php81-mysqli \
  php81-opcache \
  php81-openssl \
  php81-phar \
  php81-session \
  php81-xml \
  php81-xmlreader \
  php81-zlib \
  php81-fileinfo \
  php81-zip \
  php81-tokenizer \
  supervisor \
  && rm -rf /var/cache/apk/* 


RUN ln -s /usr/bin/php81 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.ini /etc/php81/php-fpm.d/www.conf
COPY config/php.ini /etc/php81/conf.d/custom.ini
# COPY config/xdebug.ini /etc/php81/conf.d/xdebug.ini

# Configure supervisord
COPY config/supervisord.ini /etc/supervisor.d/supervisord.ini

RUN addgroup -g 1000 eduapp && adduser -u 1000 -G eduapp -D eduapp

# Make sure files/folders needed by the processes are accessable when they run under the eduapp user
RUN chown -R eduapp.eduapp /var/www/html /run /var/lib/nginx /var/log/nginx

# Switch to use a non-root user from here on
USER eduapp
RUN mkdir /var/www/html/website

# Add application
COPY --chown=eduapp ./src/ .
# RUN composer install --no-dev
RUN chown -R eduapp.eduapp .

# Configure Laravel
RUN find . -type f -exec chmod 644 {} \;
RUN find . -type d -exec chmod 775 {} \;
RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache/

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:3000/fpm-ping

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]