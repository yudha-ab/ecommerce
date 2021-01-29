FROM php:7.4-fpm

# install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# clear cache
RUN apt-get autoclean -y

# install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PECL and PEAR extensions
RUN pecl install xdebug

# Enable PECL and PEAR extensions
RUN docker-php-ext-enable xdebug

# Copy php.ini into image
RUN echo xdebug.mode=coverage > /usr/local/etc/php/php.ini

# set working directory
WORKDIR /var/www/html

COPY --chown=www-data . /var/www/html/

# when building we need to force dev env so that dusk loads, otherwise it will refuse because of prod env
RUN echo APP_ENV=testing > .env

# set empty key so that we can generate it later
RUN echo APP_KEY= >> .env
