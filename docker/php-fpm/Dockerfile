#FROM php:5-fpm
#
#RUN docker-php-ext-install pdo_mysql
#RUN apt-get update -qq && apt-get install -y -qq git curl wget zip unzip
#
#ADD symfony.ini /usr/local/etc/php/conf.d/
#ADD symfony.pool.conf /etc/php5/fpm/pool.d/
#
#RUN usermod -u 1000 www-data
#
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
#
#WORKDIR /var/www
#
#CMD ["php-fpm", "-F"]
#
#EXPOSE 9000
#
FROM ubuntu:16.04

RUN PACKAGES="\
        php-cli \
        php-mysql \
        php-intl \
        php-xml \
        php-curl \
        php-dom \
    " && \
    apt-get update && \
    apt-get install -y $PACKAGES && \
    apt-get autoremove --purge -y && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
