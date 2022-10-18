FROM php:7.4-apache

RUN echo "ServerName 127.0.0.1" >> /etc/apache2/apache2.conf

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions intl xdebug pdo_mysql

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer

RUN curl -1sLf https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh | bash

RUN apt-get update && \
    apt-get install -y symfony-cli zip

COPY ./config/apache.conf /etc/apache2/sites-available/000-default.conf
COPY ./config/php-config.ini /usr/local/etc/php/conf.d/php-config-overrides.ini

WORKDIR /var/www/

ENTRYPOINT ["bash", "./docker.sh"]
