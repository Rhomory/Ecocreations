@extends('layouts.app')

@section('title', $product->nombre . ' — ECOCREATIONS')

@php
    $variantePorDefecto = $product->variants->first();
    $precioBase = $product->precio_base + ($variantePorDefecto?->precio_extra ?? 0);
    $precioTachado = $precioBase * 1.25;
    $ahorro = $precioTachado - $precioBase;
    $tieneVariantes = $colores->isNotEmpty() || $tamanos->isNotEmpty();
    $stockTotal = $product->variants->sum('stock');

    // Paleta para los círculos de color (fallback si el nombre no matchea)
    $colorMap = [
        'natural' => '#D9C9A3',
        'crudo' => '#E5DBC4',
        'negro' => '#1F1B16',
        'negro mate' => '#1F1B16',
        'azul' => '#4A6B7A',
        'azul oceano' => '#3A6B85',
        'verde' => '#3D4F2E',
        'verde menta' => '#A8B89A',
        'verde salvia' => '#A8B89A',
        'verde musgo' => '#5A7548',
        'coral' => '#C4724A',
        'plateado' => '#C9CCCF',
        'oro rosa' => '#D4A59A',
    ];
@endphp

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
                <li class="breadcrumb-item">
                    <a href="{{ route('catalog.show', $product->category->slug) }}"
                        class="text-decoration-none text-muted-eco">
                        {{ $product->category->nombre }}
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ $product->nombre }}</li>
            </ol>
        </nav>

        {{-- ===== Body: galería + info ===== --}}
        <div class="row g-4 g-lg-5 mt-2">

            {{-- ===== Galería ===== --}}
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex gap-3">

                    {{-- Miniaturas (vertical, izquierda) --}}
                    <div class="d-none d-md-flex flex-column gap-2" style="width: 80px;">
                        @php
                            $thumbIcons = ['bi-image', 'bi-images', 'bi-box', 'bi-stars'];
                        @endphp
                        @foreach ($thumbIcons as $i => $icon)
                            <button type="button"
                                class="btn p-0 rounded d-flex align-items-center justify-content-center
                                       {{ $i === 0 ? 'bg-secondary border border-dark border-2' : 'bg-light border' }}"
                                style="height: 80px;">
                                <i
                                    class="bi {{ $icon }} fs-4 {{ $i === 0 ? 'text-primary' : 'text-muted-eco opacity-50' }}"></i>
                            </button>
                        @endforeach
                    </div>

                    {{-- Imagen principal --}}
                    <div class="flex-grow-1">
                        <div class="bg-secondary rounded position-relative d-flex flex-column justify-content-between p-4"
                            style="aspect-ratio: 3/4; min-height: 480px;">

                            {{-- Top: badges + zoom --}}
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex gap-2">
                                    <span class="badge bg-dark font-mono fs-8 px-3 py-2 rounded">ECO</span>
                                    @if ($product->es_personalizable)
                                        <span class="badge bg-accent font-mono fs-8 px-3 py-2 rounded">PERSONALIZABLE</span>
                                    @endif
                                </div>
                                <button type="button"
                                    class="btn bg-light rounded-circle d-flex align-items-center justify-content-center p-0"
                                    style="width: 44px; height: 44px;">
                                    <i class="bi bi-arrows-fullscreen text-dark"></i>
                                </button>
                            </div>

                            {{-- Centro: icono placeholder --}}
                            <div class="position-absolute top-50 start-50 translate-middle text-center">
                                <i class="bi bi-image display-1 text-primary opacity-50"></i>
                            </div>

                            {{-- Bottom: meta --}}
                            <div class="d-flex justify-content-between align-items-end">
                                <span class="font-mono fs-8 fw-bold text-dark">
                                    Nº {{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }} · 1 / 4
                                </span>
                                <span class="font-mono fs-8 fw-bold text-dark text-uppercase">
                                    Vista previa en vivo
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== Info + selectores ===== --}}
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">

                {{-- Meta: categoría pill + stock dot --}}
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="border rounded-pill px-3 py-1 font-mono fs-8 fw-bold text-uppercase text-dark">
                        <a href="{{ route('catalog.show', $product->category->slug) }}"
                            class="text-decoration-none text-muted-eco">
                            {{ $product->category->nombre }}
                        </a>
                    </span>
                    @if ($stockTotal > 0)
                        <span
                            class="d-inline-flex align-items-center gap-2 font-mono fs-8 fw-bold text-success text-uppercase">
                            <span class="rounded-circle bg-success d-inline-block" style="width: 8px; height: 8px;"></span>
                            En stock · {{ $stockTotal }} disponibles
                        </span>
                    @else
                        <span
                            class="d-inline-flex align-items-center gap-2 font-mono fs-8 fw-bold text-danger text-uppercase">
                            <span class="rounded-circle bg-danger d-inline-block" style="width: 8px; height: 8px;"></span>
                            Agotado
                        </span>
                    @endif
                </div>

                {{-- Título --}}
                <h1 class="font-serif display-5 mb-3" style="line-height: 1;">{{ $product->nombre }}</h1>

                {{-- Descripción corta --}}
                <p class="text-muted-eco mb-4">{{ $product->descripcion_corta }}</p>

                {{-- Precio --}}
                <div class="d-flex align-items-end gap-3 flex-wrap mb-4">
                    <span class="font-serif fw-medium mb-0" style="font-size: 2.75rem; line-height: 1;" id="precioFinal">
                        S/ {{ number_format($precioBase, 2) }}
                    </span>
                    <span class="text-muted-eco text-decoration-line-through font-mono fs-5 mb-1">
                        S/ {{ number_format($precioTachado, 2) }}
                    </span>
                    <span class="bg-accent text-light rounded-sm px-3 py-1 font-mono fs-8 fw-bold text-uppercase mb-1">
                        Ahorrás S/ {{ number_format($ahorro, 2) }}
                    </span>
                </div>

                <hr class="opacity-25">

                {{-- ===== Form principal ===== --}}
                <form action="{{ route('cart.add') }}" method="POST" id="formAddCart">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if ($tieneVariantes || $product->es_personalizable)
                        <div class="d-flex flex-column gap-4 mb-4">

                            {{-- Header personalización --}}
                            @if ($product->es_personalizable)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-mono fw-bold text-uppercase" style="font-size: 0.75rem;">
                                        Personalizá tu producto
                                    </span>
                                    @if ($variantePorDefecto)
                                        <span class="font-mono fs-8 fw-bold text-muted-eco text-uppercase">
                                            SKU: <span id="skuVariante">{{ $variantePorDefecto->sku }}</span>
                                        </span>
                                    @endif
                                </div>
                            @endif

                            {{-- Color: círculos --}}
                            @if ($colores->isNotEmpty())
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0 fw-semibold">Color</label>
                                        <span class="text-muted-eco fs-7" id="colorActivo">{{ $colores->first() }}</span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($colores as $i => $color)
                                            @php
                                                $key = strtolower(trim($color));
                                                $hex = $colorMap[$key] ?? '#D9D2C2';
                                            @endphp
                                            <input type="radio" class="btn-check color-radio" name="color"
                                                id="color-{{ $i }}" value="{{ $color }}"
                                                data-label="{{ $color }}" @checked($i === 0)>
                                            <label
                                                class="rounded-circle d-flex align-items-center justify-content-center color-swatch"
                                                for="color-{{ $i }}"
                                                style="width: 56px; height: 56px; background-color: {{ $hex }}; cursor: pointer;"
                                                title="{{ $color }}">
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Tamaño: bloques --}}
                            @if ($tamanos->isNotEmpty())
                                <div>
                                    <label class="form-label fw-semibold mb-2">Tamaño</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($tamanos as $i => $tamano)
                                            <input type="radio" class="btn-check" name="tamano"
                                                id="tamano-{{ $i }}" value="{{ $tamano }}"
                                                @checked($i === 0)>
                                            <label class="btn btn-size-block rounded text-center px-4 py-2"
                                                for="tamano-{{ $i }}">
                                                <span class="font-mono fw-bold fs-7 d-block">{{ $tamano }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Grabado --}}
                            @if ($product->es_personalizable)
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0 fw-semibold">Grabado láser personalizado</label>
                                        <span
                                            class="badge bg-primary font-mono fs-8 px-2 py-1 text-uppercase">Gratis</span>
                                    </div>
                                    <div class="bg-light border rounded p-3">
                                        <input type="text" name="personalizacion" id="grabadoInput"
                                            class="form-control border-0 bg-transparent font-mono fw-bold p-0 mb-2"
                                            style="font-size: 1.25rem;" placeholder="ESCRIBE TU TEXTO" maxlength="30"
                                            oninput="document.getElementById('grabadoCount').textContent = this.value.length">
                                        <div class="d-flex justify-content-between font-mono fs-8 text-muted-eco">
                                            <span>Máx. 30 caracteres · Sin costo adicional</span>
                                            <span><span id="grabadoCount">0</span> / 30</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <hr class="opacity-25">
                    @endif

                    {{-- Cantidad + CTA + favorito --}}
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        {{-- Control de cantidad (pill) --}}
                        <div class="d-inline-flex align-items-center bg-light border rounded-pill p-1" style="gap: 4px;">
                            <button type="button" onclick="ajustarCantidad(-1)"
                                class="btn rounded-circle d-flex align-items-center justify-content-center p-0"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-dash text-dark"></i>
                            </button>
                            <input type="text" name="cantidad" id="cantidad" value="1" readonly
                                class="form-control border-0 bg-transparent text-center font-mono fw-bold p-0"
                                style="width: 32px;">
                            <button type="button" onclick="ajustarCantidad(1)"
                                class="btn bg-dark rounded-circle d-flex align-items-center justify-content-center p-0"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-plus text-light"></i>
                            </button>
                        </div>

                        {{-- CTA principal --}}
                        <button type="submit"
                            class="btn btn-accent btn-lg rounded-pill px-4 flex-grow-1 fw-bold btn-animated">
                            <span class="btn-animated-label">
                                <i class="bi bi-bag-plus me-2"></i>
                                Agregar al carrito
                                <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                            </span>
                        </button>

                        {{-- Favorito --}}
                        <button type="button"
                            class="btn border rounded-circle d-flex align-items-center justify-content-center p-0"
                            style="width: 56px; height: 56px;" aria-label="Añadir a favoritos">
                            <i class="bi bi-heart text-dark fs-5"></i>
                        </button>
                    </div>
                </form>

                {{-- ===== Garantías / trust badges (4 cards) ===== --}}
                @php
                    $trust = [
                        ['icon' => 'bi-truck', 'title' => 'Envío gratis', 'sub' => 'Lima · 48h'],
                        ['icon' => 'bi-shield-check', 'title' => 'Garantía 6m', 'sub' => 'Contra defectos'],
                        ['icon' => 'bi-arrow-repeat', 'title' => 'Devolución', 'sub' => '30 días gratis'],
                        ['icon' => 'bi-tree', 'title' => '100% Eco', 'sub' => $product->material ?? 'Certificado'],
                    ];
                @endphp
                <div class="row g-2">
                    @foreach ($trust as $t)
                        <div class="col-6 col-lg-3">
                            <div class="bg-light border rounded p-3 h-100 d-flex flex-column gap-1">
                                <i class="bi {{ $t['icon'] }} text-primary fs-5"></i>
                                <p class="fw-bold mb-0 fs-7">{{ $t['title'] }}</p>
                                <p class="font-mono fs-8 text-muted-eco mb-0">{{ $t['sub'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== Descripción larga ===== --}}
        <div class="row mt-5 pt-4 border-top" data-aos="fade-up">
            <div class="col-lg-8">
                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Sobre este producto</p>
                <h2 class="font-serif fs-3 mb-3">Hecho para durar, pensado para volver al ciclo</h2>
                <p class="text-muted-eco" style="white-space: pre-line;">{{ $product->descripcion_larga }}</p>
            </div>
        </div>
    </div>

    {{-- ===== Relacionados ===== --}}
    @if ($relacionados->isNotEmpty())
        <div class="bg-light py-5 mt-5">
            <div class="container">
                <div class="mb-4" data-aos="fade-up">
                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">—— También te puede interesar</p>
                    <h2 class="font-serif display-6 mb-0">Productos relacionados</h2>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    @foreach ($relacionados as $rel)
                        <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            @include('partials.product-card', ['product' => $rel])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ===== JS ===== --}}
    @push('scripts')
        <script>
            function ajustarCantidad(delta) {
                const input = document.getElementById('cantidad');
                const nuevo = parseInt(input.value || 1) + delta;
                if (nuevo >= 1 && nuevo <= 99) input.value = nuevo;
            }

            // Mostrar nombre del color seleccionado
            document.querySelectorAll('.color-radio').forEach(r => {
                r.addEventListener('change', e => {
                    const label = e.target.dataset.label;
                    const out = document.getElementById('colorActivo');
                    if (out && label) out.textContent = label;
                });
            });

            // Agregar al carrito vía AJAX (sin recargar)
            const formAdd = document.getElementById('formAddCart');
            if (formAdd) {
                formAdd.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const btn = formAdd.querySelector('button[type="submit"]');
                    const labelOriginal = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML = '<span class="btn-animated-label"><i class="bi bi-arrow-repeat me-2"></i>Agregando…</span>';

                    try {
                        const res = await fetch(formAdd.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: new FormData(formAdd),
                        });
                        const data = await res.json();

                        if (!res.ok || !data.ok) throw new Error(data.message || 'Error al agregar');

                        const badge = document.getElementById('cartCount');
                        if (badge) badge.textContent = data.count;

                        btn.innerHTML = '<span class="btn-animated-label"><i class="bi bi-check-lg me-2"></i>¡Agregado!</span>';
                        setTimeout(() => {
                            btn.innerHTML = labelOriginal;
                            btn.disabled = false;
                        }, 1500);
                    } catch (err) {
                        btn.innerHTML = '<span class="btn-animated-label"><i class="bi bi-x-lg me-2"></i>Error, reintentá</span>';
                        setTimeout(() => {
                            btn.innerHTML = labelOriginal;
                            btn.disabled = false;
                        }, 2000);
                    }
                });
            }
        </script>
    @endpush
@endsection
