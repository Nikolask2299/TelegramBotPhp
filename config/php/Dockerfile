FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git  

RUN apt-get install -y libpq-dev && docker-php-ext-install pgsql pdo_pgsql pdo

RUN curl -sS https://getcomposer.org/installer | php

WORKDIR /var/www/php

CMD [ "php-fpm" ]