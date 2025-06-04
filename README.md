# 1. Установка и настройка проекта<br>
Клонирование репозитория
```
git clone https://github.com/VARD0V/library-project.ru.git
cd library-project.ru<br>
```
## 2. Установка зависимостей Composer<br>
```
composer install
```
## 3. Настройка окружения
Создайте файл .env:
```
cp .env.example .env
```
Отредактируйте файл .env, указав свои настройки базы данных:
```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=libraryAi
DB_USERNAME=root
DB_PASSWORD=
```
## 4. Генерация ключа приложения
```
php artisan key:generate
```
## 5. Настройка хранилища
```
php artisan storage:link
```
## 6. Настройка базы данных

Если возникли ошибки при миграции, выполните сброс и повторное заполнение:
```
php artisan migrate:fresh --seed
```
