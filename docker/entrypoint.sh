#!/bin/sh

composer update

php artisan key:generate
php artisan migrate
php artisan optimize:clear
php artisan config:cache

#composer dump-autoload

php-fpm
