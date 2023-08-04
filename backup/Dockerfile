# Используем базовый образ с PHP-FPM
FROM php:8.1-fpm

# Установка необходимых пакетов и расширений PHP
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        nginx \
        libcurl4-gnutls-dev \
        libxml2-dev \
        libpq-dev \
        zip \
        unzip && \
    docker-php-ext-install curl xml pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
ENV COMPOSER_HOME /composer
ENV PATH "/composer/vendor/bin:$PATH"
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем конфигурацию Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Копируем код проекта в контейнер
WORKDIR /var/www/html
COPY . /var/www/html

# Открываем порты для Nginx
EXPOSE 8001

# Изменяем владельца директории storage
RUN chown -R www-data:www-data /var/www/html/storage

# Задаем права доступа к директории storage
RUN chmod -R 775 /var/www/html/storage

# Запускаем серверы PHP-FPM и Nginx
CMD php-fpm -D && nginx -g "daemon off;"
