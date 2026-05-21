@extends('layouts.app')

@section('title', 'Catálogo — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
        </ol>
    </nav>

    {{-- Header + orden --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4" data-aos="fade-up">
        <div>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">
                —— Todos los productos · {{ $products->total() }} artículos
            </p>
            <h1 class="font-serif display-4 mb-0">Catálogo completo</h1>
        </div>

        {{-- Orden: form GET que recarga conservando los demás filtros --}}
        <form method="GET" action="{{ route('catalog.index') }}" id="ordenForm">
            {{-- Mantener filtros activos al cambiar el orden --}}
            @foreach (request()->except('orden', 'page') as $key => $val)
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
            @endforeach
            <select name="orden" class="form-select rounded-pill" onchange="this.form.submit()">
                <option value="recientes" @selected(request('orden') === 'recientes' || ! request('orden'))>
                    Ordenar: Más recientes
                </option>
                <option value="precio_asc" @selected(request('orden') === 'precio_asc')>
                    Ordenar: Precio (menor a mayor)
                </option>
                <option value="precio_desc" @selected(request('orden') === 'precio_desc')>
                    Ordenar: Precio (mayor a menor)
                </option>
            </select>
        </form>
    </div>

    <div class="row g-4">

        {{-- ===== Sidebar de filtros ===== --}}
        <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card border sticky-lg-top" style="top: 6rem;">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="font-mono fw-bold fs-6 mb-0">FILTROS</h2>
                        <span class="font-mono fs-7 text-muted-eco">{{ $products->total() }} productos</span>
                    </div>
                    <hr class="opacity-25">

                    <form method="GET" action="{{ route('catalog.index') }}">

                        {{-- Búsqueda --}}
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" name="q" class="form-control"
                                placeholder="Buscar producto..." value="{{ request('q') }}">
                        </div>

                        {{-- Categorías --}}
                        <p class="font-mono fw-bold fs-7 text-uppercase mb-2">Categoría</p>
                        <hr class="mt-0 opacity-25">
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="categoria"
                                    id="cat-todas" value="" @checked(! request('categoria'))>
                                <label class="form-check-label d-flex justify-content-between" for="cat-todas">
                                    <span>Todas</span>
                                </label>
                            </div>
                            @foreach ($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="categoria"
                                        id="cat-{{ $cat->slug }}" value="{{ $cat->slug }}"
                                        @checked(request('categoria') === $cat->slug)>
                                    <label class="form-check-label d-flex justify-content-between"
                                        for="cat-{{ $cat->slug }}">
                                        <span>{{ $cat->nombre }}</span>
                                        <span class="font-mono text-muted-eco fs-7">{{ $cat->products_count }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Precio máximo --}}
                        <p class="font-mono fw-bold fs-7 text-uppercase mb-2">Precio máximo</p>
                        <hr class="mt-0 opacity-25">
                        <div class="mb-4">
                            <input type="range" class="form-range" name="precio_max"
                                min="10" max="200" step="10"
                                value="{{ request('precio_max', 200) }}"
                                oninput="document.getElementById('precioVal').textContent = 'S/ ' + this.value">
                            <div class="d-flex justify-content-between font-mono fs-7">
                                <span>S/ 10</span>
                                <span id="precioVal">S/ {{ request('precio_max', 200) }}</span>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill">
                                Aplicar filtros
                            </button>
                            <a href="{{ route('catalog.index') }}"
                                class="btn btn-outline-secondary rounded-pill">
                                <i class="bi bi-x"></i> Limpiar filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===== Grid de productos ===== --}}
        <div class="col-lg-9">

            {{-- Banner "Producto del mes" --}}
            @if ($featured)
                <div class="card bg-primary border-0 mb-4" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-5">
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                    style="height: 220px;">
                                    <i class="bi bi-stars fs-1 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p class="font-mono fs-8 text-accent text-uppercase mb-2">
                                    Producto destacado
                                </p>
                                <h2 class="font-serif fs-2 text-light mb-2">{{ $featured->nombre }}</h2>
                                <p class="text-secondary mb-3">{{ $featured->descripcion_corta }}</p>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <span class="font-mono fw-bold fs-4 text-light">
                                        S/ {{ number_format($featured->precio_base, 2) }}
                                    </span>
                                    <a href="{{ route('product.show', $featured->slug) }}"
                                        class="btn btn-accent rounded-pill px-4 btn-animated">
                                        <span class="btn-animated-label">
                                            Ver producto
                                            <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Cards --}}
            @if ($products->count())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4">
                    @foreach ($products as $product)
                        <div class="col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>

                {{-- Paginación --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            @else
                {{-- Estado vacío --}}
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted-eco opacity-50"></i>
                    <h3 class="font-serif fs-4 mt-3">No encontramos productos</h3>
                    <p class="text-muted-eco">
                        Prueba ajustando los filtros o limpiándolos para ver todo el catálogo.
                    </p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary rounded-pill px-4">
                        Ver todo el catálogo
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
