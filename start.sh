#!/bin/bash

# Crear .env desde variables de entorno de Render
cat > /var/www/.env << EOF
APP_NAME="${APP_NAME}"
APP_ENV="${APP_ENV}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG}"
APP_URL="${APP_URL}"

APP_LOCALE=es
APP_FALLBACK_LOCALE=en

DB_CONNECTION="${DB_CONNECTION}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

CLOUDINARY_URL="${CLOUDINARY_URL}"
CLOUDINARY_UPLOAD_PRESET="${CLOUDINARY_UPLOAD_PRESET}"
EOF

# Aviso ruidoso si falta CLOUDINARY_URL (sin abortar el deploy:
# el sitio sigue funcionando, solo las imagenes no se siembran).
if [ -z "${CLOUDINARY_URL}" ]; then
  echo "================================================================"
  echo "WARN: CLOUDINARY_URL no esta seteada en las env vars de Render."
  echo "      Las imagenes de productos NO se podran subir."
  echo "      Agregala en Render Dashboard -> Environment."
  echo "================================================================"
fi

# Migraciones + Seeders (seeders son idempotentes; no duplican datos)
php artisan migrate --force
php artisan db:seed --force

# Cachear
php artisan config:cache
php artisan route:cache

# Iniciar PHP-FPM
php-fpm -D

# Iniciar Nginx
nginx -g "daemon off;"
