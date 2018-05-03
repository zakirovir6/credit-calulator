FROM php:7.2-fpm-alpine

RUN apk add --no-cache --virtual .persistent-deps \
    # for intl
    icu-dev

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

CMD php bin/console doctrine:migrations:migrate -n