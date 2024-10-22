FROM php:8-fpm

RUN ( curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - || echo 'return 1' ) | sh -s \
    @composer

USER www-data

ADD . /var/www/app
ADD www.conf /usr/local/etc/php/conf.d/www.conf

WORKDIR /var/www/app
