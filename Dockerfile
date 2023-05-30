# Образ php + fpm + alpine из внешнего репозитория
FROM php:8.1-fpm-alpine as base
 
# Задаем расположение рабочей дирректории
WORKDIR /var/www/application

# RUN   set -xe \
#     	&& docker-php-ext-install -j$(nproc) pdo \
#     	&& docker-php-ext-install -j$(nproc) pdo_mysql \
# 		&& docker-php-ext-install -j$(nproc) pcntl \
# 		&& docker-php-ext-install -j$(nproc) gd

# Install common system packages for PHP extensions recommended for Yii 2.0 Framework
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
        pcntl \
        soap \
        zip \
        bcmath \
        exif \
        gd \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        imagick

FROM base

# Указываем, что текущая папка проекта копируется в рабочую дирректорию контейнера https://docs.docker.com/engine/reference/builder/#copy
COPY . ${WORK_DIR}
 

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
