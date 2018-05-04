FROM php:7.2-fpm-alpine

RUN apk add --no-cache curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/share/nginx/html

CMD composer install