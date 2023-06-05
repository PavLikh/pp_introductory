#!/bin/bash

echo "# .env.dist
MYSQL_USER=admin
MYSQL_PASSWORD=111111
MYSQL_HOST=mysql
MYSQL_PORT=3306
MYSQL_DATABASE=app_db" >> .env

docker-compose up
composer install
php yii migrate-module --interactive=0