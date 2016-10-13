#!/bin/bash
composer dump-autoload
php artisan clear-compiled
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan optimize

php artisan queue:restart

php artisan migrate:status
php artisan route:list
php artisan env
