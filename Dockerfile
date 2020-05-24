FROM php:7.4.3-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./src /var/www/html
COPY ./apache /etc/apache2/sites-enabled