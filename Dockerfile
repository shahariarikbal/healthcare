FROM php:7.4-apache

RUN apt-get update && \
    apt-get install -y \
            libpng-dev \
            libjpeg-dev \
            libfreetype6-dev \
            zlib1g-dev \
            libssh2-1-dev \
            libzip-dev \
            libxml2-dev \
            openssh-client

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN pecl install ssh2-1.3.1

RUN a2enmod rewrite && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install mysqli pdo pdo_mysql gd  zip xml soap

RUN docker-php-ext-enable ssh2

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1