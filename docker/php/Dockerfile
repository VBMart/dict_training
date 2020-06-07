FROM php:7.3-fpm
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libpng-dev \
	&& docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install mysqli \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN composer global require laravel/installer
RUN composer global require laravel/ui

WORKDIR /var/www/html/dt