#!/bin/bash

# Crear .env desde variables de entorno de Render
cat > /var/www/.env << EOF
APP_NAME="${APP_NAME}"
APP_ENV="${APP_ENV}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG}"
APP_URL="${APP_URL}"

DB_CONNECTION="${DB_CONNECTION}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"
EOF

# Migraciones + Seeders
php artisan migrate --force
php artisan db:seed --force

# Cachear
php artisan config:cache
php artisan route:cache

# Iniciar PHP-FPM
php-fpm -D

# Iniciar Nginx
nginx -g "daemon off;"