FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      supervisor \
      git && \
      docker-php-ext-install pdo pdo_pgsql pgsql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update && \
    apt-get install -y libzip-dev libonig-dev libcurl4-openssl-dev unzip && \
    pecl install redis && \
    docker-php-ext-enable redis

COPY ./docker/local/app/php.ini /usr/local/etc/php/conf.d/php.ini

RUN docker-php-ext-install pcntl
RUN apt-get update && apt-get install supervisor -y

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /var/www
COPY ./ /var/www
