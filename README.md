
#### Задача 1

#### Клонирование репозитория в директорию с проектами

```bash
$ cd ~/projects
$ git clone git@github.com:PavLikh/pp_introductory.git
```

Создать .env файл или выполнить скрипт 

```bash
$ ./env.sh

```

####  .env файл

#### MySQL settings
MYSQL_USER=admin \
MYSQL_PASSWORD=111111 \
MYSQL_HOST=mysql \
MYSQL_PORT=3306 \
MYSQL_DATABASE=app_db

#### Запуск контейнеров
Установить пакеты,
запустить контейнеры,
подготовить БД:
выполнить миграцию

```bash
docker-compose up
composer install
php yii migrate-module --interactive=0

```

> Перед запуском нужно убедиться что выключены другие контейнеры и службы, слушающие порт 80
