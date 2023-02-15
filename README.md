## Screenshoot
![Sribu Travel](https://github.com/Faturar/sribu-travel/blob/main/screenshoot.png "Sribu Travel")

## Deskripsi
Just a personal project for study. 

## User
/login
admin:
user: admin@admin.com
pass: 12345678

## Demo
https://sribu.faturar.my.id

## Techstack
- Laravel 6
- Bootstrap 4

## Feature



## Install

php 7.2

Download atau clone project dari github:

```sh
git clone https://github.com/Faturar/sribu-travel.git
```

```sh
composer install
```

copy atau ubah file env.example menjadi .env dan isi kan nama database anda.
setelah itu ketikkan pada terminal:

```sh
php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan optimize
php artisan db:seed
```
