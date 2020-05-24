FROM php:7.4.3-apache

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql

COPY ./apache/ports.conf /etc/apache2/ports.conf
COPY ./apache/sites-enabled /etc/apache2/sites-enabled
COPY ./src /var/www/html
