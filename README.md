# ECOCREATIONS

E-commerce de productos eco-amigables personalizables.
Proyecto final PAWD-503 — SENATI.

**Stack:** Laravel 12 · PHP 8.2+ · MySQL · Bootstrap 5 · Vite · AOS

---

## Requisitos previos

- PHP 8.2 o superior
- Composer 2.x
- Node.js 18+ y npm
- MySQL (XAMPP recomendado)
- Git

---

## Instalación inicial (solo la primera vez)

```bash
# 1. Instalar dependencias PHP
composer install

# 2. Instalar dependencias JS
npm install

# 3. Copiar archivo de entorno
copy .env.example .env

# 4. Generar APP_KEY
php artisan key:generate
```

Editar `.env` con los datos de tu base local:

```env
APP_NAME=ECOCREATIONS
APP_LOCALE=es
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecocreations_db
DB_USERNAME=root
DB_PASSWORD=
```

### Crear la base de datos

1. Iniciar **XAMPP** → arrancar Apache y MySQL
2. Abrir phpMyAdmin (http://localhost/phpmyadmin)
3. Crear base de datos `ecocreations_db` (utf8mb4_unicode_ci)

### Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto crea las 15 tablas y carga datos de prueba (4 categorías, 8 productos, 3 cupones, usuarios admin/cliente, 4 métodos de pago).

**Usuarios de prueba** (definidos en `UserSeeder`):
- Admin: `admin@ecocreations.com` / `password`
- Cliente: `cliente@ecocreations.com` / `password`

---

## Ejecutar el proyecto (uso diario)

Necesitas **dos terminales abiertas** al mismo tiempo:

### Terminal 1 — Servidor Laravel

```bash
php artisan serve
```

Quedará escuchando en http://localhost:8000

### Terminal 2 — Vite (assets en caliente)

```bash
npm run dev
```

Compila SCSS y JS, recarga el navegador automáticamente al guardar.

> Si no levantas Vite, los estilos no cargarán y verás la página sin diseño.

---

## Comandos útiles

### Base de datos

```bash
# Borrar todo y volver a sembrar (RESETEA datos)
php artisan migrate:fresh --seed

# Solo correr migraciones nuevas
php artisan migrate

# Solo correr seeders sin tocar tablas
php artisan db:seed

# Correr un seeder específico
php artisan db:seed --class=ProductSeeder
```

### Caché (si algo se ve raro)

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

O todo de una sola vez:

```bash
php artisan optimize:clear
```

### Rutas y debug

```bash
# Listar todas las rutas
php artisan route:list

# Listar solo rutas admin
php artisan route:list --name=admin
```

### Build de producción

```bash
npm run build
```

Genera los assets compilados en `public/build/`.

---

## Estructura del proyecto

```
ecocreations/
├── app/Http/Controllers/
│   ├── Auth/              → LoginController, RegisterController
│   ├── Admin/             → DashboardController, ProductController, OrderController, CategoryController, CouponController
│   ├── HomeController.php
│   ├── CatalogController.php
│   ├── ProductController.php
│   ├── CartController.php
│   ├── CheckoutController.php
│   ├── AccountController.php
│   └── PageController.php
├── database/
│   ├── migrations/        → 15 tablas
│   └── seeders/           → 6 seeders
├── resources/
│   ├── views/             → Blade templates
│   │   ├── layouts/app.blade.php
│   │   ├── partials/      → navbar, footer
│   │   ├── home.blade.php
│   │   └── catalog/, product/, cart/, checkout/, account/, auth/, pages/, admin/
│   ├── sass/app.scss      → Variables Bootstrap + paleta ECOCREATIONS
│   └── js/app.js          → Bootstrap + AOS
└── routes/web.php         → 49 rutas (5 públicas, 5 auth, 11 cliente, 25 admin)
```

---

## Paleta de colores

| Variable | Hex | Uso |
|----------|-----|-----|
| `$primary` | `#3D4F2E` | Verde oliva profundo (acciones principales) |
| `$secondary` | `#A8B89A` | Verde sage (apoyo) |
| `$accent` | `#C4724A` | Terracota (CTAs destacados) |
| `$body-bg` | `#F5F0E6` | Crema (fondo) |

Definidas en `resources/sass/app.scss` antes del `@import "bootstrap"`.

---

## Tipografías

- **Fraunces** → Titulares (`.font-serif`)
- **Inter Tight** → Texto general (default)
- **JetBrains Mono** → Datos, badges, precios (`.font-mono`)

Cargadas desde Google Fonts en `layouts/app.blade.php`.

---

## Niubiz (sandbox)

Configurado en modo sandbox para pruebas. No requiere RUC.
Los 3 endpoints usados son:

- Generar token de sesión
- Mostrar modal de pago (frontend)
- Confirmar transacción

Ver implementación en `CheckoutController`.

---

## Solución de problemas comunes

**"Vite manifest not found"**
→ Falta correr `npm run dev` o `npm run build`.

**"SQLSTATE[HY000] [1049] Unknown database"**
→ La base `ecocreations_db` no existe. Crearla en phpMyAdmin.

**"Class 'X' not found"**
→ Correr `composer dump-autoload`.

**Los estilos no se actualizan**
→ `php artisan view:clear` y verificar que `npm run dev` esté corriendo.

**Puerto 8000 ocupado**
→ `php artisan serve --port=8080`

---

## Diseño de referencia

El archivo `untitled.pen` (carpeta padre del proyecto) contiene todas las pantallas como referencia visual para la maquetación. Se abre con [Pencil](https://pencil.so/).
