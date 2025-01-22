FROM php:8.2-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/

COPY ./app /var/www/html/

CMD ["php", "-S", "0.0.0.0:8080", "-t", "app/public"]