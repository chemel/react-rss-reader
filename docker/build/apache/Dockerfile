FROM php:7.4-apache

## Basic tools
RUN apt update -y && \
    apt upgrade -y && \
    apt install -y bash \
            curl \
            wget \
            ca-certificates \
            nano

## Apache
RUN a2enmod rewrite

## PHP
RUN docker-php-ext-install pdo_mysql

## Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/symfony
