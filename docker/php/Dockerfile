FROM php:8.3-fpm

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

COPY docker/php/settings/php.ini /usr/local/etc/php/conf.d/php.ini
COPY docker/php/settings/docker.conf /usr/local/etc/php-fpm.d/docker.conf 
