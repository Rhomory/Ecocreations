@extends('layouts.app')

@section('title', 'ECOCREATIONS — Productos ecológicos personalizados')

@section('content')

    {{-- ============================================================ --}}
    {{-- HERO — Carrusel de 3 slides con productos destacados --}}
    {{-- ============================================================ --}}
    @php
        // Copy curado por slide: cada destacado se presenta con una historia distinta.
        // Si hay menos de 3 productos destacados, se completa con $destacados.
        $copyHero = [
            ['kicker' => '— Colección 2026', 'titulo' => 'Productos<br><em>ecológicos,</em><br>hechos a tu<br>medida.', 'texto' => 'Botellas, bolsas y utensilios sostenibles que personalizás con tu nombre, tu marca o tu causa. Producción peruana, materiales certificados.'],
            ['kicker' => '— Producción local', 'titulo' => '<em>Hecho</em><br>en el Perú,<br>pensado para<br>durar.', 'texto' => 'Talleres peruanos con trabajo justo, materiales certificados FSC y bajo impacto en cada paso del proceso.'],
            ['kicker' => '— Personalización gratis', 'titulo' => 'Tu marca,<br>tu nombre,<br><em>tu causa.</em>', 'texto' => 'Grabado láser y serigrafía sin costo adicional. Pedidos desde 1 unidad para personas, desde 20 para empresas.'],
        ];

        $slidesParaRender = $slidesHero->isNotEmpty() ? $slidesHero : $destacados->take(3);
    @endphp

    <section class="hero-section position-relative overflow-hidden">
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="6000">

            {{-- Indicadores (barras estilo .pen) --}}
            <div class="carousel-indicators hero-indicators">
                @foreach ($slidesParaRender as $i => $_)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                        @class(['active' => $i === 0]) aria-label="Slide {{ $i + 1 }}"
                        @if ($i === 0) aria-current="true" @endif></button>
                @endforeach
            </div>

            {{-- Slides --}}
            <div class="carousel-inner">
                @foreach ($slidesParaRender as $i => $producto)
                    @php
                        $copy = $copyHero[$i] ?? $copyHero[0];
                        $imgPrincipal = $producto->images->sortByDesc('es_principal')->first();
                        $numero = str_pad($producto->id, 3, '0', STR_PAD_LEFT);
                    @endphp
                    <div @class(['carousel-item', 'active' => $i === 0])>
                        <div class="container py-5 py-lg-5">
                            <div class="row align-items-center g-4 g-lg-5">

                                {{-- Lado izquierdo: copy + producto --}}
                                <div class="col-lg-6 position-relative">
                                    <div class="d-flex align-items-center gap-2 mb-4">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 font-mono fs-8">
                                            <i class="bi bi-leaf-fill me-1"></i>100% ECO
                                        </span>
                                        <span class="font-mono fs-8 text-muted-eco text-uppercase">
                                            {{ $copy['kicker'] }}
                                        </span>
                                    </div>

                                    <h1 class="font-serif display-2 fw-normal lh-1 mb-4">
                                        {!! $copy['titulo'] !!}
                                    </h1>

                                    <p class="lead text-muted-eco mb-4 pe-lg-5">
                                        {{ $copy['texto'] }}
                                    </p>

                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        <a href="{{ route('product.show', $producto->slug) }}"
                                            class="btn btn-dark rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2">
                                            <i class="bi bi-bag"></i>
                                            Ver {{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::words($producto->nombre, 2, '')) }}
                                            <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-3">
                                            Ver catálogo
                                        </a>
                                    </div>
                                </div>

                                {{-- Lado derecho: card del producto con imagen real --}}
                                <div class="col-lg-6">
                                    <a href="{{ route('product.show', $producto->slug) }}" class="text-decoration-none text-dark">
                                        <div class="hero-image bg-secondary rounded-3 position-relative overflow-hidden d-flex flex-column justify-content-between p-4 mb-3"
                                            style="min-height: 480px;">

                                            <x-cloud-img :src="$imgPrincipal?->ruta" :alt="$producto->nombre"
                                                :w="1200" :h="960" crop="fill"
                                                class="position-absolute top-0 start-0 w-100 h-100"
                                                style="object-fit: cover; z-index: 0;" />

                                            <div class="d-flex justify-content-between align-items-start position-relative" style="z-index: 1;">
                                                <span class="font-mono fs-8 fw-bold text-light bg-dark bg-opacity-50 px-2 py-1 rounded">
                                                    N° {{ $numero }} / {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                                <span class="badge bg-dark text-light rounded-pill px-3 py-2 font-mono fs-8">
                                                    100% RECICLABLE
                                                </span>
                                            </div>

                                            <div class="position-relative rounded-2 p-3 hero-product-card" style="z-index: 1;">
                                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">{{ $producto->category->nombre ?? 'Eco' }}</p>
                                                <h3 class="font-serif fs-2 text-dark mb-1">{{ $producto->nombre }}</h3>
                                                <p class="font-mono mb-0 text-dark">S/ {{ number_format($producto->precio_base, 2) }}</p>
                                            </div>
                                        </div>
                                    </a>

                                    {{-- Stats fijas (no cambian entre slides) --}}
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="bg-light border rounded-3 p-3 p-lg-4 h-100">
                                                <h4 class="font-serif fw-bold mb-0">+12K</h4>
                                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-0 mt-1">
                                                    Productos personalizados
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-primary text-light rounded-3 p-3 p-lg-4 h-100">
                                                <h4 class="font-serif fw-bold mb-0">98%</h4>
                                                <p class="font-mono fs-8 text-light opacity-75 text-uppercase mb-0 mt-1">
                                                    Materiales sostenibles
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Controles prev / next --}}
            <button class="carousel-control-prev hero-control" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="hero-control-icon d-flex align-items-center justify-content-center bg-light border rounded-circle shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next hero-control" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="hero-control-icon d-flex align-items-center justify-content-center bg-light border rounded-circle shadow-sm">
                    <i class="bi bi-arrow-right"></i>
                </span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- CATEGORÍAS --}}
    {{-- ============================================================ --}}
    <section class="py-5">
        <div class="container py-lg-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4 mb-lg-5">
                <div data-aos="fade-up">
                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">
                        — Explorá por categoría
                    </p>
                    <h2 class="font-serif fs-1 mb-0">Cada producto, una historia.</h2>
                </div>
                <a href="{{ route('catalog.index') }}"
                    class="text-dark text-decoration-none fw-semibold d-inline-flex align-items-center gap-1">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            {{-- Grid: card grande + 3 chicas --}}
            <div class="row g-3" data-aos="fade-up" data-aos-delay="100">

                {{-- Card grande (Botellas) --}}
                <div class="col-lg-6">
                    <a href="{{ route('catalog.index') }}"
                        class="card category-card border-0 h-100 text-decoration-none overflow-hidden bg-primary"
                        style="min-height: 420px;">
                        <div class="card-body d-flex flex-column justify-content-between p-4 p-lg-5 text-light">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="font-mono fs-8 opacity-75">01 / BOTELLAS</span>
                                <i class="bi bi-arrow-up-right category-arrow fs-3"></i>
                            </div>
                            <div>
                                <h3 class="font-serif display-5 text-light mb-2">Botellas</h3>
                                <p class="text-light opacity-75 mb-0">
                                    Acero, vidrio y tritan. Grabado láser personalizado.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Cards chicas (3 apiladas) --}}
                <div class="col-lg-6">
                    <div class="row g-3 h-100">

                        <div class="col-md-6">
                            <a href="{{ route('catalog.index') }}"
                                class="card category-card border-0 h-100 text-decoration-none bg-accent"
                                style="min-height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between p-4 text-light">
                                    <span class="font-mono fs-8 opacity-75">02 / BOLSAS</span>
                                    <div>
                                        <h4 class="font-serif fs-2 text-light mb-1">Bolsas</h4>
                                        <small class="text-light opacity-75">Algodón orgánico</small>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('catalog.index') }}"
                                class="card category-card h-100 text-decoration-none bg-light border"
                                style="min-height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <span class="font-mono fs-8 text-muted-eco">03 / UTENSILIOS</span>
                                    <div>
                                        <h4 class="font-serif fs-2 mb-1">Utensilios</h4>
                                        <small class="text-muted-eco">Bambú peruano</small>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{ route('catalog.index') }}"
                                class="card category-card border-0 text-decoration-none bg-dark text-light"
                                style="min-height: 180px;">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <span class="font-mono fs-8 opacity-75">04 / PACKS ECO</span>
                                        <i class="bi bi-gift fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-serif fs-2 text-light mb-1">Packs corporativos</h4>
                                        <small class="text-light opacity-75">Regalos personalizados para tu empresa</small>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- DESTACADOS --}}
    {{-- ============================================================ --}}
    <section class="py-5" style="background-color: #E8E2D4;">
        <div class="container py-lg-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4 mb-lg-5">
                <div data-aos="fade-up">
                    <p class="font-mono fs-8 text-accent text-uppercase fw-semibold mb-2">
                        — Más pedidos esta temporada
                    </p>
                    <h2 class="font-serif fs-1 mb-0">Productos destacados</h2>
                </div>
                <a href="{{ route('catalog.index') }}"
                    class="text-dark text-decoration-none fw-semibold d-inline-flex align-items-center gap-1">
                    Ver catálogo completo <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if ($destacados->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    @foreach ($destacados as $product)
                        <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-bag-x fs-1 text-muted-eco opacity-50"></i>
                    <p class="text-muted-eco mt-3 mb-0">Pronto verás aquí nuestros productos destacados.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- MANIFIESTO --}}
    {{-- ============================================================ --}}
    <section class="py-5">
        <div class="container py-lg-4">
            <div class="row g-5 align-items-center">

                {{-- Izquierda: título + CTA --}}
                <div class="col-lg-5" data-aos="fade-right">
                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-3">
                        — Nuestro compromiso
                    </p>
                    <h2 class="font-serif display-3 lh-1 mb-4">
                        Cada compra<br>siembra futuro.
                    </h2>
                    <a href="{{ route('page.about') }}"
                        class="btn btn-accent rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2">
                        Conocer más
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Derecha: 3 puntos --}}
                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                    <div class="manifesto-points">

                        <div class="row align-items-md-center border-top py-4 g-3">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">01</span>
                            </div>
                            <div class="col-10 col-md-3">
                                <h5 class="font-serif mb-0">Materiales</h5>
                            </div>
                            <div class="col-12 col-md-8 ps-md-0 ps-5 ms-md-0 ms-1">
                                <p class="text-muted-eco mb-0">
                                    Certificados de origen sostenible y trazabilidad completa.
                                </p>
                            </div>
                        </div>

                        <div class="row align-items-md-center border-top py-4 g-3">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">02</span>
                            </div>
                            <div class="col-10 col-md-3">
                                <h5 class="font-serif mb-0">Producción</h5>
                            </div>
                            <div class="col-12 col-md-8 ps-md-0 ps-5 ms-md-0 ms-1">
                                <p class="text-muted-eco mb-0">
                                    Talleres peruanos con trabajo justo y bajo impacto.
                                </p>
                            </div>
                        </div>

                        <div class="row align-items-md-center border-top border-bottom py-4 g-3">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">03</span>
                            </div>
                            <div class="col-10 col-md-3">
                                <h5 class="font-serif mb-0">Impacto</h5>
                            </div>
                            <div class="col-12 col-md-8 ps-md-0 ps-5 ms-md-0 ms-1">
                                <p class="text-muted-eco mb-0">
                                    1% de cada venta va a proyectos de reforestación.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- TESTIMONIOS --}}
    {{-- ============================================================ --}}
    <section class="py-5 bg-light">
        <div class="container py-lg-4">

            {{-- Header --}}
            <div class="text-center mb-5" data-aos="fade-up">
                <p class="font-mono fs-8 text-accent text-uppercase fw-semibold mb-2">
                    — Lo que dicen
                </p>
                <h2 class="font-serif display-4">Cada compra es una historia.</h2>
            </div>

            {{-- Grid de testimonios --}}
            <div class="row g-4">

                {{-- Testimonio 1 --}}
                <div class="col-md-4" data-aos="fade-up">
                    <div class="testimonio-card rounded-3 p-4 h-100">
                        <i class="bi bi-quote testimonio-quote fs-1 d-block lh-1 mb-3"></i>
                        <p class="testimonio-text fs-7 mb-4">
                            La botella se ve hermosa con el grabado de mi nombre.
                            La uso todos los días en la oficina.
                        </p>
                        <div class="d-flex align-items-center gap-3 pt-3 border-top">
                            <div class="rounded-circle bg-secondary" style="width: 44px; height: 44px;"></div>
                            <div>
                                <p class="testimonio-name fw-semibold mb-0">María Espinoza</p>
                                <small class="testimonio-city font-mono fs-8">LIMA</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonio 2 (variant dark siempre activo) --}}
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonio-card is-active rounded-3 p-4 h-100">
                        <i class="bi bi-quote testimonio-quote fs-1 d-block lh-1 mb-3"></i>
                        <p class="testimonio-text fs-7 mb-4">
                            Pedimos 80 packs corporativos para fin de año.
                            La calidad y la atención fueron excelentes.
                        </p>
                        <div class="d-flex align-items-center gap-3 pt-3 border-top border-secondary">
                            <div class="rounded-circle bg-light" style="width: 44px; height: 44px;"></div>
                            <div>
                                <p class="testimonio-name fw-semibold mb-0">Joaquín Rivera</p>
                                <small class="testimonio-city font-mono fs-8">AREQUIPA</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonio 3 --}}
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonio-card rounded-3 p-4 h-100">
                        <i class="bi bi-quote testimonio-quote fs-1 d-block lh-1 mb-3"></i>
                        <p class="testimonio-text fs-7 mb-4">
                            Los utensilios de bambú son una belleza y duran muchísimo.
                            Recomendado 100%.
                        </p>
                        <div class="d-flex align-items-center gap-3 pt-3 border-top">
                            <div class="rounded-circle bg-secondary" style="width: 44px; height: 44px;"></div>
                            <div>
                                <p class="testimonio-name fw-semibold mb-0">Valentina Quispe</p>
                                <small class="testimonio-city font-mono fs-8">CUSCO</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- PROMO BANNER --}}
    {{-- ============================================================ --}}
    <section class="py-5">
        <div class="container py-lg-4">
            <div class="rounded-4 bg-dark text-light p-4 p-lg-5" data-aos="zoom-in">
                <div class="row align-items-center g-4">

                    <div class="col-lg-7">
                        <p class="font-mono fs-8 text-accent text-uppercase mb-3">
                            — Producción local
                        </p>
                        <h2 class="font-serif display-5 text-light mb-3">
                            Diseñá tu propio pack <em class="text-accent">eco</em>.
                        </h2>
                        <p class="text-light opacity-75 mb-4 pe-lg-5">
                            Pedido mínimo de 20 unidades. Asesoría gratis con nuestro equipo
                            para definir colores, materiales y grabado.
                        </p>
                        <a href="{{ route('page.contact') }}"
                            class="btn btn-accent rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2">
                            Hablar con un asesor
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="col-lg-5 text-lg-end">
                        <div class="d-inline-block text-start text-lg-end">
                            <p class="font-mono fs-8 text-light opacity-50 text-uppercase mb-2">
                                Tiempo de entrega
                            </p>
                            <h3 class="font-serif display-3 text-light mb-0">
                                7-14<small class="fs-5">días</small>
                            </h3>
                            <p class="font-mono fs-8 text-light opacity-50 text-uppercase mb-0">
                                Lima · Provincias 14-21 días
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
