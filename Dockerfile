FROM php:apache

RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install zip mysqli

RUN docker-php-ext-enable zip
