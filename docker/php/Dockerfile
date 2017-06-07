FROM php:7.1-fpm
LABEL maintainer "Michaël Perrin <contact@michaelperrin.fr>"

# Install recommended extensions for Symfony
RUN apt-get update && apt-get install -y \
        libicu-dev \
    && docker-php-ext-install \
        intl \
        opcache \
    && docker-php-ext-enable \
        intl \
        opcache

# Fix permissions
RUN usermod -u 1000 www-data

# PHPUnit
RUN curl "https://phar.phpunit.de/phpunit.phar" -L -o "phpunit.phar"
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit
