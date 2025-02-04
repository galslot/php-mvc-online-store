FROM php:8.2-fpm-alpine as base

# LABEL about the custom image
LABEL version="0.2"
LABEL description="This is custom Docker Image for the PHP-FPM and Nginx Services."

ENV TZ="Europe/Moscow"

#AIR
RUN apk update && apk upgrade && apk add --no-cache iftop htop mc

COPY ./docker/conf/etc/php8/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/conf/etc/php8/php-fpm.conf /usr/local/etc/php-fpm.conf
#COPY ./docker/conf/etc/php8/php.ini /usr/local/etc/php/php.ini

ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}

RUN addgroup -g ${GID} user && adduser -u ${UID} -G user -g user -s /bin/sh -D user

RUN mkdir -p /var/www/html

RUN chown user:user /var/www/html

WORKDIR /var/www/html

RUN apk update && apk upgrade && apk add --no-cache \
    freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev \
    postgresql-dev \
    libxml2-dev \
    libxslt-dev

RUN apk add --update --no-cache \
    coreutils \
    unzip \
    make \
    git \
    curl \
    imap-dev


RUN apk add build-base jpeg-dev zlib-dev
ENV LIBRARY_PATH=/lib:/usr/lib

## Установка расширения PHP, от которых зависит Symfony.
RUN apk add g++ 
RUN apk add icu-dev
RUN apk add libzip-dev 
RUN apk add zip

RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN docker-php-ext-enable opcache

#RUN pecl install apcu
#RUN docker-php-ext-enable apcu

RUN docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

RUN apk add --no-cache linux-headers
RUN docker-php-ext-install sockets
RUN docker-php-ext-install imap
RUN docker-php-ext-install soap


RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd

# install imagick
RUN apk update && apk add imagemagick ghostscript-fonts ghostscript
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS imagemagick-dev \
&& pecl install imagick \
&& docker-php-ext-enable imagick \
&& apk del .build-deps

# installing required extensions
RUN apk update && \
    apk add bash build-base gcc wget autoconf libmcrypt-dev \
    g++ \
    openssl-dev \
    php82-mbstring

RUN pecl install mcrypt && \
    docker-php-ext-enable mcrypt

## Установка расширения PHP	
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install xsl

RUN apk add bzip2
RUN apk add php82-bz2
RUN docker-php-ext-install bz2

RUN apk add $PHPIZE_DEPS curl-dev
RUN docker-php-ext-install curl

RUN docker-php-ext-install ctype
RUN docker-php-ext-install dom

RUN apk add php82-iconv
RUN apk add php82-json

RUN docker-php-ext-install fileinfo
#RUN docker-php-ext-install pdo
RUN docker-php-ext-install xml

RUN apk add php82-zlib

RUN docker-php-ext-install phar

RUN apk add php82-tokenizer

RUN docker-php-ext-install session
RUN docker-php-ext-install simplexml

RUN apk add php82-xdebug

RUN docker-php-ext-install xmlwriter

RUN apk add php82-xmlreader
RUN apk add php82-openssl

# MySql
RUN apk update && apk upgrade
RUN apk add ca-certificates
RUN update-ca-certificates
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

## PHP AMQP
RUN docker-php-ext-install sockets \
    && apk add --no-cache --update rabbitmq-c-dev \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install amqp-1.11.0 \
    && docker-php-ext-enable amqp \
    && apk del .phpize-deps

# composer install
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Symfony Cli
RUN apk add --no-cache bash
RUN apk add --no-cache sudo
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | sudo -E bash
RUN sudo apk add symfony-cli

RUN apk add nginx nginx-mod-http-headers-more runit

RUN rm -rf /var/cache/apk/*

# NEW
ADD ./docker/conf/sbin /sbin
ADD ./docker/conf/etc/nginx /etc/nginx
#ADD ./docker/conf/etc/php8 /etc/php82
ADD ./docker/conf/etc/service/nginx /etc/service/nginx
ADD ./docker/conf/etc/service/php-fpm /etc/service/php-fpm

# bug "cannot copy to non-directory"
COPY ./docker/conf/etc/nginx/http.d/default.conf /etc/nginx/http.d/default.conf


RUN chmod +x /sbin/runit-wrapper
RUN chmod +x /sbin/runsvdir-start
RUN chmod +x /etc/service/php-fpm/run
RUN chmod +x /etc/service/nginx/run


EXPOSE 80

CMD ["/sbin/runit-wrapper"]

FROM base as build
COPY . /var/www/html
RUN chmod -Rv 777 /var/www/html/var
RUN chmod -Rv 777 /var/www/html/public/uploads
RUN composer install --no-interaction --optimize-autoloader
RUN chmod +x bin/console
RUN chmod -Rv 777 /var/www/html/var
RUN chown www-data:www-data -R /var/www/html
