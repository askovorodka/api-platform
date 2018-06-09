FROM php:7.2-fpm-alpine
RUN apk update
RUN apk add zlib-dev git zip \
	&& docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php \
	&& mv composer.phar /usr/local/bin \
	&& ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

WORKDIR /var/www
VOLUME /var/www

