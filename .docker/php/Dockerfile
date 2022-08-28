FROM php:7.4-fpm-alpine

RUN apk add --no-cache \
    bash \
    libzip \
    libzip-dev \
    autoconf \
    bind-tools \
    gcc libc-dev make \
    sudo && \

    apk add --no-cache --virtual .phpize-deps && \

    docker-php-ext-install zip pdo pdo_mysql \
     && /bin/bash -lc "pecl install mongodb"  \
        && docker-php-ext-enable mongodb

ENV XDEBUG_VERSION=2.9.2
RUN apk --no-cache add --virtual .build-deps \
        g++ \
        autoconf \
        make && \
    pecl install xdebug-${XDEBUG_VERSION} && \
    docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer
