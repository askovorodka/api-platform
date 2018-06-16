FROM php:7.2-fpm-alpine
MAINTAINER Andrey Shmits <andrey.schmitz@gmail.com>

RUN apk update
RUN apk add zlib-dev git zip \
	&& docker-php-ext-install \
	    zip \
	    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php \
	&& mv composer.phar /usr/local/bin \
	&& ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN apk update \
    &&  apk add ca-certificates wget \
    &&  update-ca-certificates  \
    &&  wget https://phar.phpunit.de/phpunit.phar \
    &&  chmod +x phpunit.phar \
    &&  mv phpunit.phar /usr/local/bin/phpunit \
    &&  phpunit --version

# Create work dir
RUN mkdir -p /var/www/html && \
    chown -R www-data:www-data /var/www

WORKDIR /var/www/html
VOLUME /var/www/html
EXPOSE 9000 7000

USER root
CMD ["php-fpm", "-R"]