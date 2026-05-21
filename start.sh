#!/bin/bash

# Generar app key si no existe
php artisan key:generate --force

# Correr migraciones
php artisan migrate --force

# Limpiar y cachear config
php artisan config:cache
php artisan route:cache

# Iniciar PHP-FPM en background
php-fpm -D

# Iniciar Nginx en foreground
nginx -g "daemon off;"