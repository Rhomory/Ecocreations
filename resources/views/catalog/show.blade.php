@extends('layouts.app')

@section('title', $category->nombre . ' — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('catalog.index') }}" class="text-decoration-none text-muted-eco">Catálogo</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->nombre }}</li>
        </ol>
    </nav>

    {{-- Header de la Categoría + orden --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5" data-aos="fade-up">
        <div>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">
                —— Categoría · {{ $products->total() }} artículos
            </p>
            <h1 class="font-serif display-4 mb-0">{{ $category->nombre }}</h1>
            @if($category->descripcion)
                <p class="text-secondary mt-2 mb-0" style="max-width: 600px;">{{ $category->descripcion }}</p>
            @endif
        </div>

        {{-- Ordenador (Mismo que el catálogo principal) --}}
        <form method="GET" action="{{ route('catalog.show', $category->slug) }}" id="ordenForm">
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

    {{-- Grid Limpio de Productos --}}
    @if ($products->count())
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
            @foreach ($products as $product)
                <div class="col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    @else
        {{-- Estado vacío si la categoría no tiene productos activos --}}
        <div class="text-center py-5">
            <i class="bi bi-box fs-1 text-muted-eco opacity-50"></i>
            <h3 class="font-serif fs-4 mt-3">Categoría vacía</h3>
            <p class="text-muted-eco">
                Por el momento no tenemos productos activos en esta categoría.
            </p>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark rounded-pill px-4 mt-2">
                Volver al catálogo completo
            </a>
        </div>
    @endif

</div>
@endsection
