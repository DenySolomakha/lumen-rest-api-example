FROM php:8.1.7-fpm-alpine

RUN apk update && apk add --no-cache \
    libxslt-dev \
    git \
    curl \
    g++ \
    gcc \
    tar \
    zip \
    wget \
    unzip \
    openssh \
    libjpeg-turbo-dev \
    libmcrypt-dev \
    libmcrypt \
    libpng-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    shadow

RUN docker-php-ext-configure gd \
        -with-freetype=/usr/include/ \
        -with-jpeg=/usr/jpeg/

RUN docker-php-ext-install \
    pcntl \
    gd \
    opcache \
    exif \
    xsl \
    zip \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    bcmath

RUN apk add --no-cache icu-dev \
    && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --version=2.3.7 --filename=composer

#RUN if [ "dev" = "dev" ] ; then apk add --no-cache $PHPIZE_DEPS \
#&& pecl install xdebug-3.0.4  \
#&& docker-php-ext-enable xdebug ; fi

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/example-company.com

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/example-company.com

# Change current user to www
USER www

WORKDIR /var/www/example-company.com

COPY .docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY .docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/php-fpm.conf
