## Описание проекта:



Создайте базу данных в папке database с именем databse.sqlite и подключите ее, заполните поле файла .env 
```bash
  DB_CONNECTION=mysql
```


Затем, открыв из папки проекта консоль, введите команду для установки/обновления пакетов ларавел:
```bash
  composer update
```
В открытой консоли директории проекта введите команду для генерации таблиц базы данных:
```bash
  php artisan migrate
```
В той же консоли для запуска сайта по адресу http://localhost:8000 введите команду:
```bash
  php artisan serve
```
В новой консоли для запуска NodeJS и корректной работы введите команду:
```bash
  npm install npm run dev
```
Откройте сайт в браузере по адресу   http://127.0.0.1:8000


## Задание
![App Screenshot](https://github.com/Null-ch/NEXTUM-test-task/assets/134306420/7a178978-e68c-4d4c-bdf4-b64ead6c7ae2)

