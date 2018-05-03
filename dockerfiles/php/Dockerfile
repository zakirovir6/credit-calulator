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

RUN pecl install xdebug-2.6.0 \
    && pecl install APCu-5.1.8 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable apcu

RUN apk del .phpize_deps