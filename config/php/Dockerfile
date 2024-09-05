FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git 

RUN curl -sS https://getcomposer.org/installer | php

WORKDIR /var/www/php

CMD [ "php-fpm" ]