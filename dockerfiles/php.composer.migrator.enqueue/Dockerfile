FROM php:7.2-fpm-alpine

RUN apk add --no-cache curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache --virtual .persistent-deps \
    # for intl
    icu-dev

RUN apk add --no-cache bash

RUN apk add --no-cache --virtual .phpize_deps \
    $PHPIZE_DEPS

RUN docker-php-ext-install \
    mysqli \
    intl \
    opcache

RUN docker-php-ext-enable \
    mysqli \
    intl \
    opcache

RUN apk del .phpize_deps

WORKDIR /usr/share/nginx/html

COPY utils/wait-for-it/wait-for-it.sh /wait-for-it.sh

CMD composer install \
    && /wait-for-it.sh mysql:3306 --timeout=300 --strict -- \
     /wait-for-it.sh mysql:3306 --timeout=300 --strict -- \
      php bin/console doctrine:migrations:migrate -n \
      && php bin/console enqueue:consume -n