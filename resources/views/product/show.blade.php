@extends('layouts.app')

@section('title', $product->nombre . ' — ECOCREATIONS')

@php
    // Variante por defecto (primera activa) — usada para precio inicial y SKU mostrado
    $variantePorDefecto = $product->variants->first();
    $precioFinal = $product->precio_base + ($variantePorDefecto?->precio_extra ?? 0);
    $tieneVariantes = $colores->isNotEmpty() || $tamanos->isNotEmpty();
@endphp

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" data-aos="fade-up">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index') }}" class="text-decoration-none text-muted-eco">Catálogo</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index', ['categoria' => $product->category->slug]) }}"
                    class="text-decoration-none text-muted-eco">
                    {{ $product->category->nombre }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->nombre }}</li>
        </ol>
    </nav>

    {{-- ===== Body: galería + info ===== --}}
    <div class="row g-4 g-lg-5 mt-2">

        {{-- ===== Galería ===== --}}
        <div class="col-lg-6" data-aos="fade-right">
            <div class="d-flex gap-3">

                {{-- Miniaturas (vertical, izquierda) --}}
                <div class="d-none d-md-flex flex-column gap-2" style="width: 72px;">
                    @for ($i = 0; $i < 4; $i++)
                        <button type="button"
                            class="btn p-0 border rounded bg-light d-flex align-items-center justify-content-center"
                            style="height: 72px;">
                            <i class="bi bi-image fs-4 text-muted-eco opacity-50"></i>
                        </button>
                    @endfor
                </div>

                {{-- Imagen principal --}}
                <div class="flex-grow-1 position-relative">
                    <div class="bg-secondary rounded position-relative d-flex align-items-center justify-content-center"
                        style="aspect-ratio: 1; min-height: 400px;">

                        {{-- Badges sobre la imagen --}}
                        <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-2">
                            <span class="badge bg-primary font-mono fs-8">ECO</span>
                            @if ($product->es_personalizable)
                                <span class="badge bg-accent font-mono fs-8">Personalizable</span>
                            @endif
                            @if ($product->es_destacado)
                                <span class="badge bg-dark font-mono fs-8">Destacado</span>
                            @endif
                        </div>

                        <i class="bi bi-image display-1 text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Info + selectores ===== --}}
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">

            {{-- Categoría --}}
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">
                —— {{ $product->category->nombre }}
            </p>

            {{-- Título --}}
            <h1 class="font-serif display-5 mb-3">{{ $product->nombre }}</h1>

            {{-- Descripción corta --}}
            <p class="text-muted-eco mb-4">{{ $product->descripcion_corta }}</p>

            {{-- Precio --}}
            <div class="d-flex align-items-baseline gap-3 mb-4">
                <span class="font-mono fw-bold display-6 mb-0" id="precioFinal">
                    S/ {{ number_format($precioFinal, 2) }}
                </span>
                <span class="text-muted-eco text-decoration-line-through fs-6">
                    S/ {{ number_format($precioFinal * 1.2, 2) }}
                </span>
                <span class="badge bg-accent font-mono fs-8">-20%</span>
            </div>

            {{-- SKU dinámico --}}
            @if ($variantePorDefecto)
                <p class="font-mono fs-7 text-muted-eco mb-4">
                    SKU: <span id="skuVariante">{{ $variantePorDefecto->sku }}</span>
                </p>
            @endif

            <hr class="opacity-25">

            {{-- ===== Selectores de variantes (solo si hay datos) ===== --}}
            @if ($tieneVariantes)
                <form action="#" method="POST" id="formAddCart">
                    @csrf

                    {{-- Tamaño --}}
                    @if ($tamanos->isNotEmpty())
                        <div class="mb-4">
                            <p class="font-mono fw-bold fs-7 text-uppercase mb-2">Tamaño</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($tamanos as $i => $tamano)
                                    <input type="radio" class="btn-check" name="tamano"
                                        id="tamano-{{ $i }}" value="{{ $tamano }}"
                                        @checked($i === 0)>
                                    <label class="btn btn-outline-dark rounded-pill px-3" for="tamano-{{ $i }}">
                                        {{ $tamano }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Color --}}
                    @if ($colores->isNotEmpty())
                        <div class="mb-4">
                            <p class="font-mono fw-bold fs-7 text-uppercase mb-2">Color</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($colores as $i => $color)
                                    <input type="radio" class="btn-check" name="color"
                                        id="color-{{ $i }}" value="{{ $color }}"
                                        @checked($i === 0)>
                                    <label class="btn btn-outline-dark rounded-pill px-3" for="color-{{ $i }}">
                                        {{ $color }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Personalización (solo si el producto lo permite) --}}
                    @if ($product->es_personalizable)
                        <div class="bg-light rounded p-3 mb-4 border">
                            <p class="font-mono fw-bold fs-7 text-uppercase mb-3">
                                <i class="bi bi-stars text-accent"></i> Personaliza tu producto
                            </p>
                            <label class="form-label fs-7 text-muted-eco">Texto o nombre (opcional)</label>
                            <input type="text" name="personalizacion" class="form-control"
                                placeholder="Ej: Para mamá" maxlength="30">
                            <p class="font-mono fs-8 text-muted-eco mt-2 mb-0">
                                Máx. 30 caracteres · Sin costo adicional
                            </p>
                        </div>
                    @endif

                    {{-- Cantidad + CTA --}}
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <div class="input-group" style="width: 140px;">
                            <button type="button" class="btn btn-outline-dark"
                                onclick="ajustarCantidad(-1)">−</button>
                            <input type="number" name="cantidad" id="cantidad"
                                class="form-control text-center" value="1" min="1" max="99">
                            <button type="button" class="btn btn-outline-dark"
                                onclick="ajustarCantidad(1)">+</button>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 flex-grow-1 btn-animated">
                            <span class="btn-animated-label">
                                <i class="bi bi-bag-plus me-2"></i> Agregar al carrito
                                <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                            </span>
                        </button>
                    </div>

                    {{-- Stock --}}
                    <p class="font-mono fs-7 text-muted-eco mb-0">
                        <i class="bi bi-check-circle text-primary"></i>
                        Disponible · {{ $variantePorDefecto->stock }} unidades en stock
                    </p>
                </form>

            @else
                {{-- ===== Sin variantes: solo CTA simple ===== --}}
                <form action="#" method="POST">
                    @csrf
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <div class="input-group" style="width: 140px;">
                            <button type="button" class="btn btn-outline-dark"
                                onclick="ajustarCantidad(-1)">−</button>
                            <input type="number" name="cantidad" id="cantidad"
                                class="form-control text-center" value="1" min="1" max="99">
                            <button type="button" class="btn btn-outline-dark"
                                onclick="ajustarCantidad(1)">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 flex-grow-1 btn-animated">
                            <span class="btn-animated-label">
                                <i class="bi bi-bag-plus me-2"></i> Agregar al carrito
                                <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                            </span>
                        </button>
                    </div>
                </form>
            @endif

            {{-- ===== Bondades / info secundaria ===== --}}
            <hr class="opacity-25 my-4">
            <div class="row g-3">
                @php
                    $bondades = [
                        ['icono' => 'bi-truck', 'titulo' => 'Envío gratis', 'texto' => 'En compras > S/ 150'],
                        ['icono' => 'bi-shield-check', 'titulo' => 'Garantía', 'texto' => '30 días devolución'],
                        ['icono' => 'bi-leaf', 'titulo' => 'Material', 'texto' => $product->material ?? 'Eco-friendly'],
                    ];
                @endphp
                @foreach ($bondades as $b)
                    <div class="col-4">
                        <i class="bi {{ $b['icono'] }} fs-4 text-primary"></i>
                        <p class="font-mono fw-bold fs-7 mb-0 mt-1">{{ $b['titulo'] }}</p>
                        <p class="fs-8 text-muted-eco mb-0">{{ $b['texto'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== Descripción larga (debajo del fold) ===== --}}
    <div class="row mt-5 pt-4 border-top" data-aos="fade-up">
        <div class="col-lg-8">
            <h2 class="font-serif fs-3 mb-3">Sobre este producto</h2>
            <p class="text-muted-eco" style="white-space: pre-line;">{{ $product->descripcion_larga }}</p>
        </div>
    </div>
</div>

{{-- ===== Relacionados ===== --}}
@if ($relacionados->isNotEmpty())
    <div class="bg-light py-5">
        <div class="container">
            <div class="mb-4" data-aos="fade-up">
                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">—— También te puede gustar</p>
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

{{-- ===== JS mínimo (cantidad +/-) ===== --}}
@push('scripts')
<script>
    function ajustarCantidad(delta) {
        const input = document.getElementById('cantidad');
        const nuevo = parseInt(input.value || 1) + delta;
        if (nuevo >= 1 && nuevo <= 99) input.value = nuevo;
    }
</script>
@endpush
@endsection
