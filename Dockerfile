FROM php:7.4.3-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./apache/ports.conf /etc/apache2/ports.conf
COPY ./apache/sites-enabled /etc/apache2/sites-enabled
COPY ./src /var/www/html
