# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

ECOCREATIONS — a Laravel 12 e-commerce demo for eco-friendly customizable products (SENATI PAWD-503 final project). Stack: PHP 8.2+, Laravel 12, Bootstrap 5 + custom SCSS theme, Vite, AOS. UI strings and route paths are in Spanish.

This is an in-progress demo. Much of the markup and routing exists, but several controllers are still placeholder stubs (see "State of the code" below). Treat the README/STATUS docs as aspirational — verify against the actual code before assuming a feature works.

## Commands

```bash
# First-time setup (composer + npm + key + migrate + build)
composer setup

# Daily dev — runs serve + queue + pail logs + vite concurrently
composer dev

# Or run the two pieces manually in separate terminals:
php artisan serve            # http://localhost:8000
npm run dev                  # Vite HMR — without this, pages render unstyled

npm run build                # production assets into public/build/

# Tests (clears config first, then PHPUnit)
composer test
php artisan test --filter=SomeTest      # single test by name
php artisan test tests/Feature/Foo.php  # single file

# Database
php artisan migrate:fresh --seed         # reset + reseed (4 categories, 8 products, 3 coupons, users, payment methods)
php artisan db:seed --class=ProductSeeder
php artisan optimize:clear               # clear all caches when things look stale
```

Test users (from `UserSeeder`):
- Admin: `admin@ecocreations.pe` / `admin123` → redirects to `/admin`
- Cliente: `cliente@demo.pe` / `cliente123` → redirects to `/cuenta`

## Database connection — important

The committed `.env` uses **`DB_CONNECTION=pgsql`** (matching the Render/Docker deploy). The README still documents MySQL/XAMPP with `ecocreations_db`. When working locally, check `.env` for which connection is actually active rather than trusting the README. The Dockerfile installs `pdo_pgsql`/`pgsql` and runs against Postgres.

## Architecture

Standard Laravel 12 skeleton (slim `bootstrap/app.php`, no Kernel files; middleware/routing/exceptions configured via the `Application::configure` fluent API). Single route file `routes/web.php`.

**Routing tiers** (`routes/web.php`): public pages → `guest` auth routes → `auth`-gated client routes (cart, checkout, account) → `admin`-prefixed routes guarded by the `admin` middleware alias (`EnsureUserIsAdmin`, registered in `bootstrap/app.php`). The admin middleware silently `redirect()->route('home')` for anyone not authenticated with `role === 'admin'` — it deliberately does NOT return 403, to avoid revealing the admin panel exists. So `/admin` looks identical to a normal redirect for guests and regular clients.

**Controllers** split into `Admin/`, `Auth/`, and top-level storefront controllers (`Home`, `Catalog`, `Product`, `Cart`, `Checkout`, `Account`, `Page`). Admin product/category/coupon use `Route::resource`; order management is custom (`index`/`show`/`updateStatus`).

**Models** (`app/Models/`) cover the full domain: `User` → `ClientProfile`/`Address`/`Cart`/`Order`; `Cart` → `CartItem`; `Order` → `OrderItem`/`Invoice`/`OrderStatusHistory`; `Product` → `ProductImage`/`ProductVariant`/`Category`; plus `Coupon` and `PaymentMethod`. 18 migrations define the schema; 6 seeders orchestrated by `DatabaseSeeder`.

**Views** (`resources/views/`): `layouts/app.blade.php` is the base (navbar, footer, `<x-page-loader />`, Vite, Google Fonts). Feature folders: `catalog/`, `product/`, `cart/`, `checkout/`, `account/`, `auth/`, `pages/`, `admin/`. The layout accepts `$hideNav` / `$hideFooter` Blade props — used by `auth/login.blade.php` and `admin/dashboard.blade.php` to suppress the public chrome. There's also a Blade component at `resources/views/components/page-loader.blade.php` (used as `<x-page-loader />`).

**Auth flow**: real, wired up.
- `LoginController::login()` does `Auth::attempt()` + `regenerate()`, then redirects via `redirigirSegunRol()`: `admin → admin.dashboard`, everyone else → `account.index`. Respects `intended()`.
- `RegisterController::register()` creates a `User` with `role='cliente'`, auto-logs in, sends to `account.index`. `role` is in `User::$fillable`.
- The login view (`auth/login.blade.php`) holds both Login and Register tabs in one form. It auto-selects the Register tab if validation errors came from registration (uses `$errors->hasAny(['name'])` heuristic).

### State of the code (stubs to be aware of)

- `CheckoutController` returns static views and a hardcoded `order=1`; **Niubiz payment is NOT integrated** despite the README describing a sandbox flow. The git history mentions a Niubiz sandbox in a separate "EcoModa" demo, not this codebase.
- Most admin controllers beyond `DashboardController` are still placeholder stubs.

## Frontend / theming

The custom Bootstrap theme is the distinctive part of this project — read `COLORS.md` before doing UI work. Theme variables and custom utilities live in `resources/sass/app.scss`, defined **before** `@import "bootstrap"` (overrides) and **after** (custom utilities).

Key gotchas:
- `$accent` (terracotta `#C4724A`) is **not** a Bootstrap theme color — use `.bg-accent`/`.text-accent`/`.btn-accent`, not `var(--bs-accent)`.
- `$headings-color` is dark, so headings on dark backgrounds need an explicit `.text-light`.
- Icons: project uses **Bootstrap Icons** (`bi-*`), even though the `.pen` design reference uses Lucide.
- Custom utilities: `.fs-7`/`.fs-8`, `.font-serif` (Fraunces, titles), `.font-mono` (JetBrains Mono, prices/badges), `.text-muted-eco`, `.category-card`, `.testimonio-card`, `.navbar-animated`, `.btn-animated` (lift + slide-arrow + sheen), `.page-loader`, `.auth-form-col`.

**Overflow / AOS**: `html, body { overflow-x: clip }` is set globally because AOS fade-left/right briefly moves elements outside the viewport. This is intentional — don't change it to `hidden` (breaks `position: sticky`). On mobile (`<= 767.98px`), `resources/js/app.js` rewrites every `data-aos` other than `fade-up` to `fade-up` before AOS init, so the lateral animations don't cause a layout hiccup on phones.

**Page loader**: `<x-page-loader />` is included once in `layouts/app.blade.php`. It's a dark splash with a rotating leaf + ring (SVG path taken from the `.pen`'s "Hoja giratoria" variant) shown when:
- Any same-origin internal `<a href>` is clicked (filters `#`, `_blank`, modifier keys, mailto/tel via URL parse).
- Any non-GET form is submitted.
It hides on `pageshow` with a 500ms minimum visible time to avoid flicker. All wiring lives in `resources/js/app.js`.

## Deployment

Dockerized for Render. `Dockerfile` builds PHP-FPM + nginx + Node, runs `composer install --no-dev` and `npm run build`. `start.sh` generates `.env` from Render env vars at boot, then runs `migrate --force` + `db:seed --force` (seeders are written to guard against duplicates) + `config:cache`/`route:cache`. App is forced to HTTPS in production. Exposes port 10000.

## Conventions

- The user prefers **terse** Spanish responses — no intermediate screenshots, just final confirmation.
- `STATUS.md` tracks layout/markup progress and design decisions; update it when completing UI work.
- The visual design reference is `ecocreations.pen` in the parent directory (`E:\brayan\Laravel\ecocreations.pen`). Open it via the Pencil MCP tools (`mcp__pencil__*`), not Read/Grep — `.pen` files are encrypted. Always call `get_editor_state(include_schema: true)` first to load the schema.
- Spanish-language UI: route names use English (`product.show`, `account.index`) but URL paths and visible strings are in Spanish (`/producto/{slug}`, `/cuenta`).
