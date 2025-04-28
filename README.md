# book_registry

Системный требования:
● PHP 8+
● PHP-фреймворк Laravel 10+
● СУБД MySQL 8+ в качестве базы данных

● Composer 2.8.8

Клонируйте репозиторий:
git clone <ваш-репозиторий>
cd <папка-проекта>

Установка PHP зависимостей:
composer install

    **_Настройка окружения_**

Генерация ключа приложения:
php artisan key:generate

Редактирование файла .env:
APP_KEY={КЛЮЧ ПРИЛОЖЕНИЯ}

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=НАЗВАНИЕ-БД
DB_USERNAME=ПОЛЬЗОВАТЕЛЬ
DB_PASSWORD=ПАРОЛЬ

    **_Запуск миграций и сидеров_**

Выполните миграции:
php artisan migrate

Создание администратора в БД:
php artisan db:seed --class=AdminUserSeeder

Логин: admin@admin.ru
Пароль: root

Создание пользователя происходит через регистрацию на сайте

Запуск приложения на локальном сервере:
php artisan serve

Логи хранятся по пути: book_registry\storage

Выдача данных в формате JSON:

1.  Запрос на авторизацию пользователя
    POST http://localhost:8000/api/login

    Body:
    {
    "email": "user3@user.ru",
    "password": "123"
    }

2.  Получение списка книг с именем автора, авторизация не обязательна (с пагинацией)
    GET http://localhost:8000/api/books?per_page={КОЛ-ВО ОБЪЕКТОВ НА СТРАНИЦУ}

3.  Получение данных книги по id, авторизация не обязательна
    GET http://localhost:8000/api/books/{ID}

4.  Обновление данных книги, авторизация под автором книги обязательна
    PUT http://localhost:8000/api/books/{ID}

    Headers:
    Authorization:Bearer {TOKEN}
    Content-Type: application/json

    Body:
    {
    "title": "111",
    "author_id": 4,
    "type": "digital",
    "genres": [2]
    }

5.  Удаление книги, авторизация под автором книги обязательна
    DELETE http://localhost:8000/api/books/{ID}

    Headers:
    Authorization:Bearer {TOKEN}
    Content-Type: application/json

6.  Получение списка авторов с указанием количества книг, авторизация не обязательна (с пагинацией)
    GET http://localhost:8000/api/authors?per_page={КОЛ-ВО ОБЪЕКТОВ НА СТРАНИЦУ}

7.  Получение данных автора со списком книг, авторизация не обязательна
    GET http://localhost:8000/api/authors/{ID}

8.  Обновление данных автора, авторизация под автором обязательна (можно обновлять только свои данные)
    PUT http://localhost:8000/api/authors/{ID}

    Headers:
    Authorization:Bearer {TOKEN}
    Content-Type: application/json

    Body:
    {
    "name": "ИмЯ"
    }

9.  Список жанров со списком книг внутри (с пагинацией)
    GET http://localhost:8000/api/genres?per_page={КОЛ-ВО ОБЪЕКТОВ НА СТРАНИЦУ}
