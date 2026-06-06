@extends('layouts.app')

@section('title', 'Mi Carrito — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" data-aos="fade-up">
        <ol class="breadcrumb fs-7 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index') }}" class="text-decoration-none text-muted-eco">Catálogo</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Carrito</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mt-3 mb-4" data-aos="fade-up" data-aos-delay="50">
        <div>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Tu carrito de compras</p>
            <h1 class="font-serif display-4 mb-0">Carrito</h1>
        </div>
        <a href="{{ route('catalog.index') }}" class="text-dark text-decoration-none fw-semibold d-inline-flex align-items-center gap-1 fs-7">
            <i class="bi bi-arrow-left"></i> Seguir comprando
        </a>
    </div>

    @if (session('status'))
        <div class="alert alert-success border-0 rounded-3 d-flex align-items-center gap-2" data-aos="fade-up">
            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
        </div>
    @endif

    @if (empty($items))
        {{-- ===== Estado vacío ===== --}}
        <div class="text-center py-5 my-5" data-aos="fade-up">
            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4"
                 style="width: 96px; height: 96px;">
                <i class="bi bi-bag fs-1 text-muted-eco opacity-50"></i>
            </div>
            <h3 class="font-serif fs-2 mb-2">Tu carrito está vacío</h3>
            <p class="text-muted-eco mb-4">Descubrí nuestros productos eco y empezá a personalizarlos.</p>
            <a href="{{ route('catalog.index') }}" class="btn btn-accent rounded-pill px-4 py-3 fw-bold btn-animated">
                <span class="btn-animated-label">
                    <i class="bi bi-shop me-2"></i> Ver catálogo
                    <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                </span>
            </a>
        </div>
    @else
    <div class="row g-4 g-lg-5">

        {{-- ===== Columna Izquierda: Items del carrito ===== --}}
        <div class="col-lg-8">

            {{-- Header de la tabla (solo desktop) --}}
            <div class="d-none d-md-flex align-items-center border-bottom pb-3 mb-3 font-mono fs-8 text-muted-eco text-uppercase" data-aos="fade-up">
                <div class="flex-grow-1">Producto</div>
                <div style="width: 130px;" class="text-center">Cantidad</div>
                <div style="width: 100px;" class="text-end">Total</div>
                <div style="width: 44px;"></div>
            </div>

            {{-- Items --}}
            @foreach ($items as $item)
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 border-bottom py-3 py-md-4 cart-item"
                     data-clave="{{ $item['clave'] }}"
                     data-precio="{{ $item['precio'] }}"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">

                    {{-- Imagen + Info --}}
                    <div class="d-flex align-items-center gap-3 flex-grow-1 w-100">
                        <x-cloud-img :src="$item['imagen'] ?? null" :alt="$item['nombre']"
                            :w="192" :h="192" crop="fill"
                            class="bg-secondary rounded flex-shrink-0"
                            style="width: 96px; height: 96px; object-fit: cover;" />
                        <div class="flex-grow-1 min-w-0">
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">{{ $item['categoria'] }}</p>
                            <h3 class="font-serif fs-5 mb-1">
                                <a href="{{ route('product.show', $item['slug']) }}" class="text-decoration-none text-body">{{ $item['nombre'] }}</a>
                            </h3>
                            @php
                                $variantStr = collect([$item['color'], $item['tamano']])->filter()->implode(' · ');
                            @endphp
                            @if ($variantStr)
                                <p class="fs-7 text-muted-eco mb-0">{{ $variantStr }}</p>
                            @endif
                            @if ($item['personalizacion'])
                                <span class="badge bg-primary font-mono fs-8 mt-1">
                                    <i class="bi bi-pencil-fill me-1"></i>{{ $item['personalizacion'] }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Cantidad (pill) --}}
                    <div class="d-flex align-items-center justify-content-between w-100 d-md-block" style="max-width: 100%; width: auto;">
                        <span class="font-mono fw-bold fs-6 d-md-none">S/ {{ number_format($item['precio'], 2) }}</span>

                        <div class="d-inline-flex align-items-center bg-light border rounded-pill p-1" style="gap: 4px;">
                            <button type="button" class="btn rounded-circle d-flex align-items-center justify-content-center p-0 cart-qty-btn"
                                data-delta="-1" style="width: 36px; height: 36px;" aria-label="Disminuir">
                                <i class="bi bi-dash text-dark"></i>
                            </button>
                            <input type="text" value="{{ $item['cantidad'] }}" readonly
                                class="form-control border-0 bg-transparent text-center font-mono fw-bold p-0 cart-qty-input"
                                style="width: 28px; font-size: 0.875rem;">
                            <button type="button" class="btn bg-dark rounded-circle d-flex align-items-center justify-content-center p-0 cart-qty-btn"
                                data-delta="1" style="width: 36px; height: 36px;" aria-label="Aumentar">
                                <i class="bi bi-plus text-light"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Total línea --}}
                    <div class="d-none d-md-block text-end" style="width: 100px;">
                        <span class="font-mono fw-bold cart-line-total">S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                    </div>

                    {{-- Eliminar --}}
                    <button type="button" class="btn border-0 text-muted-eco p-1 cart-remove-btn" aria-label="Eliminar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endforeach
        </div>

        {{-- ===== Columna Derecha: Resumen ===== --}}
        <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
            <div class="card border sticky-lg-top" style="top: 6rem;">
                <div class="card-body p-4">
                    <h2 class="font-mono fw-bold fs-6 text-uppercase mb-4">Resumen del pedido</h2>

                    {{-- Cupón --}}
                    <div class="input-group mb-4">
                        <input type="text" class="form-control rounded-start-pill border-end-0" placeholder="Código de cupón">
                        <button class="btn btn-outline-dark rounded-end-pill px-3 font-mono fs-8 fw-bold" type="button">APLICAR</button>
                    </div>

                    <hr class="opacity-25">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-eco">Subtotal (<span id="cartItemCount">{{ count($items) }}</span> artículos)</span>
                        <span class="font-mono fw-semibold" id="cartSubtotal">S/ {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-eco">Envío estándar</span>
                        <span class="font-mono fw-semibold">S/ {{ number_format($envio, 2) }}</span>
                    </div>

                    <hr class="opacity-25">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="font-mono fw-bold fs-4" id="cartTotal">S/ {{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="btn btn-accent btn-lg w-100 rounded-pill font-mono fw-bold d-flex align-items-center justify-content-center gap-2 py-3 btn-animated">
                        <span class="btn-animated-label">
                            Ir al checkout <i class="bi bi-arrow-right btn-animated-icon"></i>
                        </span>
                    </a>

                    <div class="d-flex justify-content-center gap-4 mt-4 pt-2">
                        <div class="text-center">
                            <i class="bi bi-shield-check text-primary fs-5 d-block"></i>
                            <span class="font-mono fs-8 text-muted-eco">Pago seguro</span>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-truck text-primary fs-5 d-block"></i>
                            <span class="font-mono fs-8 text-muted-eco">Envío 48h</span>
                        </div>
                        <div class="text-center">
                            <i class="bi bi-arrow-repeat text-primary fs-5 d-block"></i>
                            <span class="font-mono fs-8 text-muted-eco">30 días</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif
</div>

@push('scripts')
<script>
    const ENVIO_BASE = {{ $envio }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function formatearPrecio(num) {
        return 'S/ ' + num.toFixed(2);
    }

    function recalcularResumen() {
        let subtotal = 0;
        document.querySelectorAll('.cart-item').forEach(row => {
            const precio = parseFloat(row.dataset.precio);
            const cantidad = parseInt(row.querySelector('.cart-qty-input').value);
            const total = precio * cantidad;
            const totalCell = row.querySelector('.cart-line-total');
            if (totalCell) totalCell.textContent = formatearPrecio(total);
            subtotal += total;
        });
        const filas = document.querySelectorAll('.cart-item').length;
        const sub = document.getElementById('cartSubtotal');
        const tot = document.getElementById('cartTotal');
        const count = document.getElementById('cartItemCount');
        const envio = filas > 0 ? ENVIO_BASE : 0;
        if (sub) sub.textContent = formatearPrecio(subtotal);
        if (tot) tot.textContent = formatearPrecio(subtotal + envio);
        if (count) count.textContent = filas;
    }

    async function actualizarCantidad(clave, nuevaCantidad) {
        const res = await fetch(`/carrito/${clave}`, {
            method: 'PATCH',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cantidad=${nuevaCantidad}`,
        });
        const data = await res.json();
        if (data.ok) {
            const badge = document.getElementById('cartCount');
            if (badge) badge.textContent = data.count;
        }
    }

    async function eliminarItem(clave, row) {
        const res = await fetch(`/carrito/${clave}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
        });
        const data = await res.json();
        if (data.ok) {
            row.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateX(-10px)';
            setTimeout(() => {
                row.remove();
                const badge = document.getElementById('cartCount');
                if (badge) badge.textContent = data.count;
                recalcularResumen();
                if (document.querySelectorAll('.cart-item').length === 0) {
                    window.location.reload();
                }
            }, 250);
        }
    }

    document.querySelectorAll('.cart-qty-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('.cart-item');
            const input = row.querySelector('.cart-qty-input');
            const delta = parseInt(btn.dataset.delta);
            const nuevo = parseInt(input.value) + delta;
            if (nuevo < 1 || nuevo > 99) return;
            input.value = nuevo;
            recalcularResumen();
            actualizarCantidad(row.dataset.clave, nuevo);
        });
    });

    document.querySelectorAll('.cart-remove-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('.cart-item');
            eliminarItem(row.dataset.clave, row);
        });
    });
</script>
@endpush
@endsection
