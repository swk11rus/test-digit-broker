ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm

RUN apt-get update -y \
    && apt-get install -y nginx

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache

RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
 } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

COPY nginx.conf /etc/nginx/nginx.conf
COPY single.local.conf /etc/nginx/sites-enabled/default
COPY entrypoint.sh /etc/entrypoint.sh

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

EXPOSE 80 443

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]