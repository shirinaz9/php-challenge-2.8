FROM ubuntu:16.04

RUN PACKAGES="\
        nodejs \
        nodejs-legacy \
        npm \
        php-cli \
        php-mysql \
        php-intl \
        php-xml \
        php-curl \
        php-dom \
        wget \
        zip \
        unzip \
        git \
        libfreetype6 \
        libfontconfig \
    " && \
    apt-get update && \
    apt-get install -y $PACKAGES && \
    apt-get autoremove --purge -y && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN cd /tmp && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    rm -rf /tmp/*
