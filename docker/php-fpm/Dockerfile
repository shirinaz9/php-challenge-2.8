FROM php:5-fpm

RUN docker-php-ext-install pdo_mysql
RUN apt-get update -qq && apt-get install -y -qq git curl wget zip unzip

ADD symfony.ini /usr/local/etc/php/conf.d/
ADD symfony.pool.conf /etc/php5/fpm/pool.d/

RUN usermod -u 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /var/www/symfony

CMD ["php-fpm", "-F"]

EXPOSE 9000
