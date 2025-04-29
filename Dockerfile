FROM php:apache

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    libxml2-dev \
    git \
    curl \
    unzip \
    libgd-dev && \
    docker-php-ext-install zip mysqli gd && \
    docker-php-ext-enable zip gd && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN git config --global --add safe.directory /var/www/html

COPY . /var/www/html

RUN echo "<Directory /var/www/html> \n \
    Options Indexes FollowSymLinks \n \
    AllowOverride All \n \
    Require all granted \n \
    </Directory>" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

RUN composer require phpoffice/phpspreadsheet phpoffice/phpword
