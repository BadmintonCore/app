FROM --platform=linux/amd64 php:8.4-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PHP_EXTENSIONS "iconv curl pgsql mysqli pdo pdo_pgsql pdo_mysql intl zip soap gd bcmath exif"

RUN set -ex \
    && apt-get update && apt-get install --no-install-recommends -y \
       locales \
       wget \
       git \
       gpg \
       gpg-agent \
       dirmngr \
       openssh-client \
       rsync \
       libfreetype6-dev \
       libjpeg62-turbo-dev \
       libmcrypt-dev \
       libpng-dev \
       libcurl4-gnutls-dev \
       libpq-dev \
       libicu-dev \
       libxml2-dev \
       msmtp \
       libzip-dev \
       nano \
       mariadb-client \
	&& locale-gen de_DE.UTF-8 \
	&& update-locale \
    && mkdir ~/.gnupg \
    && chmod 0700 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) $PHP_EXTENSIONS \
    && a2enmod rewrite \
    && a2enmod proxy \
    && a2enmod proxy_http \
    && a2enmod proxy_fcgi \
	&& curl --silent --show-error https://getcomposer.org/installer | php -- \
	   --force --install-dir=/usr/local/bin --filename=composer \
    && apt-get autoremove -y

RUN pecl install xdebug \
&& docker-php-ext-enable xdebug


WORKDIR /var/www/html

COPY conf/vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY conf/php.ini /usr/local/etc/php/php.ini
COPY conf/msmtprc /etc/msmtprc

EXPOSE 80
EXPOSE 9003

CMD ["apache2-foreground"]