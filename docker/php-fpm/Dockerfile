FROM ubuntu:16.04

RUN PACKAGES="\
        php-cli \
        php-mysql \
        php-intl \
        php-xml \
        php-curl \
        php-dom \
        php-mbstring \
    " && \
    apt-get update && \
    apt-get install -y $PACKAGES && \
    apt-get autoremove --purge -y && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
