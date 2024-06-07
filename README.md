## Установка 

### Установка

С помощью Git
```bash
git clone https://github.com/AnvilM/DD-Dentistry Dentistry
cd Dentistry
```

Установка зависимостей
```bash
composer install
```

### Конфигурация

Создание .env файла
```bash
cp .env.example .env
```

Генерация appKey и adminKey
```bash
php artisan key:generate
php artisan gen:key
```

Данные БД в файле .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dd_dentistry
DB_USERNAME=root
DB_PASSWORD=root
```

### Запуск

```bash
cd public
php -S localhost:8000
```




## Документация

Документация описанна в [swagger.yaml](https://github.com/AnvilM/DD-Dentistry/blob/main/swagger.yaml)