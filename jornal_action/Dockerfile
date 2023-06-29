 FROM composer:2.5.5 as composer

FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    apt-utils \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

# Копирование остальных файлов проекта
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.* ./
COPY . ./
# Копирование и установка зависимостей Laravel
RUN composer install --no-scripts --no-autoloader

# Генерация автозагрузки и выполнение скриптов post-install
RUN composer dump-autoload --optimize && \
    php artisan optimize