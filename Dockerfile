FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git \
        unzip \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libonig-dev && \
    docker-php-ext-install \
        pdo_pgsql \
        pdo_mysql \
        mbstring \
        bcmath \
        intl \
        opcache && \
    a2enmod rewrite headers && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install \
        --no-dev \
        --prefer-dist \
        --no-interaction \
        --optimize-autoloader && \
    mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        storage/app/public && \
    chown -R www-data:www-data \
        storage \
        bootstrap/cache && \
    ln -sfn \
        /var/www/html/storage/app/public \
        /var/www/html/public/storage

COPY docker/entrypoint.sh /usr/local/bin/bars-entrypoint

RUN chmod +x /usr/local/bin/bars-entrypoint

EXPOSE 10000

ENTRYPOINT ["bars-entrypoint"]