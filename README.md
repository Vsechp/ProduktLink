Описание проекта:
Создайте базу данных в папке database с именем databse.sqlite и подключите ее, заполните поле файла .env 

  DB_CONNECTION=mysql

Затем, открыв из папки проекта консоль, введите команду для установки/обновления пакетов ларавел:

  composer update

В открытой консоли директории проекта введите команду для генерации таблиц базы данных:

  php artisan migrate

В той же консоли для запуска сайта по адресу http://localhost:8000 введите команду:

  php artisan serve

В новой консоли для запуска NodeJS и корректной работы введите команду:

  npm install npm run dev

Откройте сайт в браузере по адресу http://127.0.0.1:8000

Задание:
Реализовать сущности
Товары
Категории
Товар-Категория
Реализовать выдачу данных в формате json по RESTful
Создание Товаров (у каждого товара может быть от 2 до 10 категорий)
[POST] http://localhost:8000/products
Редактирование Товаров
[PUT] http://localhost:8000/products/{product_id}
Удаление товаров (товар помечается как удаленный)
[DELETE] http://localhost:8000/products/{product_id}
Создание категорий
[POST] http://localhost:8000/category
Удаление категорий (вернуть ошибку если категория прикреплена к товару)
[DELETE] http://localhost:8000/category/{category_id}
Получение списка товаров
[GET] http://localhost:8000/products
Имя / по совпадению с именем
[GET] http://localhost:8000/products?name=Test
id категории
[GET] http://localhost:8000/products?category_id={category_id}
Название категории / по совпадению с категорией
[GET] http://localhost:8000/products?category_name=Test
Цена от – до
[GET] http://localhost:8000/products?prices=101,120
Опубликованные – да / нет
[GET] http://localhost:8000/products?is_published=0

