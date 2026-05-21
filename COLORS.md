# Paleta de colores ECOCREATIONS

Referencia rápida de variables SCSS, clases Bootstrap utility y utilidades propias.
Definidas en `resources/sass/app.scss`.

---

## Paleta principal (variables Bootstrap sobrescritas)

| Variable SCSS | Hex | Nombre | Uso típico |
|---|---|---|---|
| `$primary` | `#3D4F2E` | Verde bosque | Acciones principales, botones primary, hero |
| `$secondary` | `#A8B89A` | Verde salvia | Apoyo, badges suaves |
| `$success` | `#5A7548` | Verde musgo | Mensajes de éxito |
| `$info` | `#4A6B7A` | Azul tinta | Info / alertas neutras |
| `$warning` | `#C4854A` | Ámbar | Advertencias |
| `$danger` | `#9B3B2E` | Ladrillo | Errores, destructive |
| `$light` | `#F5F0E6` | Crema | Fondos claros |
| `$dark` | `#1F1B16` | Tierra oscura | Texto, footer |
| `$accent` | `#C4724A` | Terracota | CTAs destacados (NO es Bootstrap estándar) |

### Otros tokens

| Variable SCSS | Hex | Uso |
|---|---|---|
| `$body-bg` | `#F5F0E6` | Fondo general (crema) |
| `$body-color` | `#1F1B16` | Texto principal |
| `$border-color` | `#D9D2C2` | Bordes suaves |
| `$muted-color` | `#6B6359` | Texto secundario |

---

## Clases de Bootstrap (auto-generadas desde la paleta)

### Fondos (`.bg-*`)

| Clase | Color |
|---|---|
| `.bg-primary` | Verde bosque `#3D4F2E` |
| `.bg-secondary` | Verde salvia `#A8B89A` |
| `.bg-success` | Verde musgo `#5A7548` |
| `.bg-info` | Azul tinta `#4A6B7A` |
| `.bg-warning` | Ámbar `#C4854A` |
| `.bg-danger` | Ladrillo `#9B3B2E` |
| `.bg-light` | Crema `#F5F0E6` |
| `.bg-dark` | Tierra oscura `#1F1B16` |
| `.bg-accent` ⭐ | Terracota `#C4724A` (custom) |
| `.bg-body` | Igual a `$body-bg` |
| `.bg-transparent` | Transparente |

### Texto (`.text-*`)

| Clase | Color |
|---|---|
| `.text-primary` | Verde bosque |
| `.text-secondary` | Verde salvia |
| `.text-success` | Verde musgo |
| `.text-info` | Azul tinta |
| `.text-warning` | Ámbar |
| `.text-danger` | Ladrillo |
| `.text-light` | Crema |
| `.text-dark` | Tierra oscura |
| `.text-accent` ⭐ | Terracota (custom) |
| `.text-muted` | Gris Bootstrap default |
| `.text-muted-eco` ⭐ | `#6B6359` cálido (custom) |
| `.text-body` | Texto principal |
| `.text-white` | Blanco puro |

### Botones (`.btn-*`)

| Clase | Estilo |
|---|---|
| `.btn-primary` | Fondo verde bosque, texto crema |
| `.btn-secondary` | Fondo verde salvia |
| `.btn-success` | Fondo verde musgo |
| `.btn-info` | Fondo azul tinta |
| `.btn-warning` | Fondo ámbar |
| `.btn-danger` | Fondo ladrillo |
| `.btn-light` | Fondo crema |
| `.btn-dark` | Fondo tierra oscura |
| `.btn-accent` ⭐ | Fondo terracota, hover oscurece 8% |
| `.btn-outline-primary` | Borde verde, fondo transparente |
| `.btn-outline-secondary` | Borde salvia |
| `.btn-outline-success` | Borde musgo |
| `.btn-outline-info` | Borde tinta |
| `.btn-outline-warning` | Borde ámbar |
| `.btn-outline-danger` | Borde ladrillo |
| `.btn-outline-light` | Borde crema (sobre fondo oscuro) |
| `.btn-outline-dark` | Borde tierra |
| `.btn-outline-accent` ⭐ | Borde terracota, hover invertido |

**Tamaños:** `.btn-sm`, `.btn-lg`
**Combinaciones útiles:** `class="btn btn-primary btn-lg"`

### Bordes (`.border-*`)

| Clase | Color |
|---|---|
| `.border` | Color default `$border-color` |
| `.border-primary` | Verde bosque |
| `.border-secondary` | Verde salvia |
| `.border-success` | Verde musgo |
| `.border-info` | Azul tinta |
| `.border-warning` | Ámbar |
| `.border-danger` | Ladrillo |
| `.border-light` | Crema |
| `.border-dark` | Tierra oscura |

**Modificadores:** `.border-0`, `.border-top`, `.border-end`, `.border-bottom`, `.border-start`

### Badges (`.badge` + bg)

```html
<span class="badge bg-primary">100% ECO</span>
<span class="badge bg-success">Disponible</span>
<span class="badge bg-danger">Agotado</span>
<span class="badge bg-accent">Nuevo</span>
```

### Alertas (`.alert-*`)

```html
<div class="alert alert-success">Éxito</div>
<div class="alert alert-warning">Advertencia</div>
<div class="alert alert-danger">Error</div>
<div class="alert alert-info">Info</div>
```

---

## Utilidades propias (custom)

Definidas en `app.scss` después del `@import "bootstrap"`.

| Clase | Efecto |
|---|---|
| `.text-accent` | Color terracota `#C4724A` |
| `.bg-accent` | Fondo terracota |
| `.btn-accent` | Botón terracota (con hover) |
| `.btn-outline-accent` | Botón outline terracota |
| `.font-serif` | Fuente **Fraunces** (titulares) |
| `.font-mono` | Fuente **JetBrains Mono** (datos, badges) |
| `.text-muted-eco` | Gris cálido `#6B6359` |

---

## Tipografías

| Nombre | Variable | Uso |
|---|---|---|
| **Fraunces** | `$font-family-serif` | Titulares (`.font-serif`, h1–h6) |
| **Inter Tight** | `$font-family-sans-serif` | Texto general (default body) |
| **JetBrains Mono** | `$font-family-monospace` | Precios, badges, datos (`.font-mono`) |

Cargadas desde Google Fonts en `layouts/app.blade.php`.

---

## Border radius

| Variable | Valor | Uso |
|---|---|---|
| `$border-radius` | `12px` | Default (cards, inputs) |
| `$border-radius-sm` | `4px` | Pequeño (badges) |
| `$border-radius-lg` | `20px` | Grande (hero, banners) |
| `$border-radius-pill` | `999px` | Pill (chips, CTAs redondeados) |

**Clases:** `.rounded`, `.rounded-sm`, `.rounded-lg`, `.rounded-pill`, `.rounded-circle`, `.rounded-0`

---

## Ejemplos prácticos

### Hero con CTA principal + secundario
```html
<a href="#" class="btn btn-primary btn-lg">Ver catálogo</a>
<a href="#" class="btn btn-outline-accent btn-lg">Conocer la marca</a>
```

### Card de producto
```html
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <span class="badge bg-success font-mono">ECO</span>
    <h5 class="font-serif">Botella Andina</h5>
    <p class="text-muted-eco small">Acero doble pared</p>
    <p class="font-mono fs-4 text-accent">S/ 49.90</p>
  </div>
</div>
```

### Footer (texto sobre fondo oscuro)
```html
<footer class="bg-dark text-light py-5">
  <p class="text-muted small">© 2026 ECOCREATIONS</p>
</footer>
```

---

## Atajo en VS Code

Si querés autocomplete de estas clases, instalá la extensión **IntelliSense for CSS class names in HTML** o **Tailwind CSS IntelliSense** apuntando al CSS compilado de Bootstrap (en `public/build/`).
