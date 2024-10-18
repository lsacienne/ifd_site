FROM php:7.4-apache
COPY src/ /var/www/html/
COPY arts/ /var/www/html/arts
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
RUN echo "output_buffering = 4096" > /usr/local/etc/php/php.ini
EXPOSE 80
