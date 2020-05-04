#!/bin/bash
set -e

cd /var/www; php artisan config:cache 
env >> /var/www/.env
php-fpm7.2 -D
php artisan storage:link
php artisan migrate
nginx -g "daemon off;"
