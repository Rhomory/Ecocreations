# Estado actual de ECOCREATIONS

> Última actualización: 2026-05-11
> Proyecto: PAWD-503 SENATI — E-commerce Laravel para ECOCREATIONS S.A.C.

---

## Stack y entorno

- Laravel 12 + PHP 8.2+
- MySQL/XAMPP — BD: `ecocreations_db`
- Bootstrap 5.3+ con tema SCSS personalizado (paleta "Bosque tibio")
- Bootstrap Icons (`bi-*`)
- Vite + AOS (Animate On Scroll)
- Niubiz sandbox (pendiente integrar)
- Pencil app + MCP (NO usar la extensión de Antigravity, choca con el binario MCP)

---

## Diseño en `.pen`

Archivo: `E:\brayan\Laravel\ecocreations.pen`

### Pantallas ya maquetadas

| # | Pantalla | Posición x |
|---|----------|-----------|
| 1 | Home | inicio |
| ... | (catálogo, detalle, carrito, checkout, login, register, mi cuenta, etc.) | varias |
| 11 | Contacto | 16120 |
| 11b | Sobre nosotros | 17680 |
| 12 | Términos y condiciones | 19240 |
| 13 | Política de privacidad | 20800 |
| 14 | Envíos y entregas | 22360 |
| 15 | Cambios y devoluciones | 23920 |

### Referencia de colores

- `E:\brayan\Laravel\ecocreations-colors.pen` — paleta visual compacta
- `E:\brayan\Laravel\ecocreations\COLORS.md` — referencia de clases SCSS

---

## Laravel — Estado de la maquetación

### Layout base
- `layouts/app.blade.php` — incluye navbar, footer, `auth-modal`, Vite, Google Fonts
- `partials/navbar.blade.php` — sticky-top, animación de entrada, modal de auth para guests, dropdown para auth users. Sin link "Inicio" (logo redirige a home)
- `partials/footer.blade.php` — 4 columnas (Marca, Tienda, Empresa, Ayuda) + social en `font-mono fs-8`
- `partials/auth-modal.blade.php` — modal de Bootstrap para login/register (solo @guest)

### Páginas maquetadas con Bootstrap
- ✅ `home.blade.php` — Hero, Categorías (4 cards con `.category-card` hover), Destacados (placeholder), Manifiesto, Testimonios (`.testimonio-card` con hover verde), Promo Banner

### Páginas pendientes de maquetar
- Catálogo (`catalog.index`)
- Detalle de producto
- Carrito
- Checkout
- Login / Register (vistas propias, no solo modal)
- Mi cuenta + Mis pedidos + Mis direcciones
- Admin (dashboard + CRUDs)
- Sobre nosotros (`page.about`) — ya está en `.pen`, falta blade
- Contacto (`page.contact`) — placeholder creado, falta maquetación
- 4 páginas legales — ya están en `.pen`, falta crear blades + rutas

---

## SCSS — Utilidades propias en `resources/sass/app.scss`

Variables clave:
- `$primary: #3D4F2E` (verde bosque), `$secondary: #A8B89A` (salvia), `$accent: #C4724A` (terracota — NO está en `$theme-colors`, usar `.bg-accent` no `var(--bs-accent)`)
- `$light: #F5F0E6` (crema), `$dark: #1F1B16` (tierra oscura)
- `$headings-color: $dark` → IMPORTANTE: sobre fondos oscuros agregar `.text-light` explícito a los `<h*>`

Clases custom:
- `.fs-7` (~13px), `.fs-8` (~11px)
- `.footer-links` — lista con hover terracota
- `.navbar-animated` — slideDownFade 0.5s
- `.category-card` + `.category-arrow` — hover lift + flecha
- `.testimonio-card` — hover verde primario
- `.btn-accent`, `.btn-outline-accent`, `.text-accent`, `.bg-accent`, `.font-serif`, `.font-mono`

---

## Tareas pendientes

| ID | Tarea | Estado |
|----|-------|--------|
| #29 | Maquetar pantallas reales con Bootstrap (Catálogo, Detalle, Carrito, Checkout, Login, Cuenta, Admin) | En curso |
| #43 | Reordenar canvas del `.pen` por importancia visual | **Diferido al final del proyecto** (decisión del usuario) |

Próximos pasos sugeridos cuando volvamos:
1. Maquetar `pages/contact.blade.php` siguiendo el `.pen` (#11)
2. Maquetar `pages/about.blade.php` siguiendo el `.pen` (#11b)
3. Crear rutas + blades de las 4 páginas legales
4. Continuar con Catálogo

---

## Decisiones y gotchas importantes

- **Auth UX**: se eligió **modal de Bootstrap** (no dropdown ni accordion) porque el dropdown desbordaba en pantallas <430px
- **Iconos**: el `.pen` usa Lucide pero el proyecto Laravel usa **Bootstrap Icons** → mapeo mental (ej. lucide `check-circle` → bi `bi-check-circle`)
- **MCP de Pencil**: solo permite UNA conexión a la vez. Si Antigravity está corriendo con su extensión de Pencil, hay que cerrarla antes de usar el MCP desde Claude
- **Subir a Dribbble** está planeado para cuando termine el proyecto
- El usuario prefiere respuestas **terse**, sin screenshots intermedios — solo confirmación al final

---

## Archivos de referencia rápida

- `README.md` — instrucciones de ejecución (composer install, npm, php artisan serve, etc.)
- `COLORS.md` — referencia de paleta y clases
- `STATUS.md` — este archivo
