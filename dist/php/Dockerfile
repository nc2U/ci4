FROM php:8.2-fpm

# Installing dependencies for the PHP modules
RUN apt-get update && \
    apt-get install -y zip curl libcurl3-dev libzip-dev libpng-dev libonig-dev libxml2-dev
    # libonig-dev is needed for oniguruma which is needed for mbstring

# Installing additional PHP modules
RUN docker-php-ext-install intl
RUN docker-php-ext-install curl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install xml
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

# Install Composer so it's available
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
