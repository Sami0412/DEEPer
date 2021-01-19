FROM php:7.4-fpm-buster

RUN apt-get update \
    && apt-get install -y libzip-dev \
                        zip \
                        libicu-dev \
                        g++ \
                        libfreetype6-dev \
                        libjpeg62-turbo-dev \
                        libpng-dev \
                        libmagick++-dev \
                        libmagickwand-dev \
                        imagemagick
RUN apt-get install --fix-missing -y xvfb

RUN pecl install xdebug-2.9.6 \
    && pecl install imagick \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure calendar \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable xdebug imagick \
    && docker-php-ext-install bcmath calendar intl pdo pdo_mysql mysqli opcache exif zip sysvsem

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN echo "pm.max_children = 10" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "request_terminate_timeout = 600" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_value[error_log] = /dev/stderr" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN mkdir -p /var/www/sites/deeper.local

WORKDIR /var/www/sites/deeper.local
