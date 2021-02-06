#!/bin/bash
set -e

cd /var/www; php artisan config:cache 
env >> /var/www/.env
php-fpm7.2 -D
php artisan storage:link

echo "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" >> cronfile
crontab cronfile
rm cronfile

cron -f & 
nginx -g "daemon off;"
