@extends('layouts.app')

@section('title', 'ECOCREATIONS — Productos ecológicos personalizados')

@section('content')

    {{-- ============================================================ --}}
    {{-- HERO --}}
    {{-- ============================================================ --}}
    <section class="hero-section position-relative overflow-hidden py-5 py-lg-0">
        <div class="container py-lg-5">
            <div class="row align-items-center g-4 g-lg-5">

                {{-- Lado izquierdo: texto --}}
                <div class="col-lg-6 position-relative">
                    {{-- Badge superior --}}
                    <div class="d-flex align-items-center gap-2 mb-4" data-aos="fade-up">
                        <span
                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 font-mono fs-8">
                            <i class="bi bi-leaf-fill me-1"></i>100% ECO
                        </span>
                        <span class="font-mono fs-8 text-muted-eco text-uppercase">
                            — Colección 2026
                        </span>
                    </div>

                    {{-- Título --}}
                    <h1 class="font-serif display-2 fw-normal lh-1 mb-4" data-aos="fade-up" data-aos-delay="100">
                        Productos<br>
                        <em>ecológicos,</em><br>
                        hechos a tu<br>
                        medida.
                    </h1>

                    {{-- Subtítulo --}}
                    <p class="lead text-muted-eco mb-4 pe-lg-5" data-aos="fade-up" data-aos-delay="200">
                        Botellas, bolsas y utensilios sostenibles que personalizás con tu nombre,
                        tu marca o tu causa. Producción peruana, materiales certificados.
                    </p>

                    {{-- CTAs --}}
                    <div class="d-flex flex-wrap gap-3 mb-3" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('catalog.index') }}"
                            class="btn btn-dark rounded-pill px-4 py-3 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-bag"></i>
                            Ver catálogo
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <a href="{{ route('page.about') }}" class="btn btn-outline-dark rounded-pill px-4 py-3">
                            Conocer la marca
                        </a>
                    </div>
                </div>

                {{-- Lado derecho: imagen + bottom row --}}
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    {{-- Imagen principal --}}
                    <div class="hero-image bg-secondary rounded-3 d-flex flex-column justify-content-between p-4 mb-3"
                        style="min-height: 480px;">

                        <div class="d-flex justify-content-between align-items-start">
                            <span class="font-mono fs-8 text-dark">N° 001 / 24</span>
                            <span class="badge bg-dark text-light rounded-pill px-3 py-2 font-mono fs-8">
                                100% RECICLABLE
                            </span>
                        </div>

                        <div>
                            <h3 class="font-serif fs-2 text-dark mb-1">Botella Andina · 600ml</h3>
                            <p class="font-mono mb-0 text-dark">S/ 49.90</p>
                        </div>
                    </div>

                    {{-- Bottom row: 2 estadísticas --}}
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
    {{-- DESTACADOS (PLACEHOLDER — completar más tarde) --}}
    {{-- ============================================================ --}}
    <section class="py-5" style="background-color: #E8E2D4;">
        <div class="container py-lg-4">
            <div class="text-center py-5">
                <span class="badge bg-warning text-dark font-mono px-3 py-2">
                    SECCIÓN EN CONSTRUCCIÓN
                </span>
                <p class="text-muted-eco mt-3 mb-0">
                    Productos destacados — se completará más tarde
                </p>
            </div>
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

                        <div class="row align-items-center border-top py-4">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">01</span>
                            </div>
                            <div class="col-3 col-md-3">
                                <h5 class="font-serif mb-0">Materiales</h5>
                            </div>
                            <div class="col-7 col-md-8">
                                <p class="text-muted-eco mb-0">
                                    Certificados de origen sostenible y trazabilidad completa.
                                </p>
                            </div>
                        </div>

                        <div class="row align-items-center border-top py-4">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">02</span>
                            </div>
                            <div class="col-3 col-md-3">
                                <h5 class="font-serif mb-0">Producción</h5>
                            </div>
                            <div class="col-7 col-md-8">
                                <p class="text-muted-eco mb-0">
                                    Talleres peruanos con trabajo justo y bajo impacto.
                                </p>
                            </div>
                        </div>

                        <div class="row align-items-center border-top border-bottom py-4">
                            <div class="col-2 col-md-1">
                                <span class="font-mono text-muted-eco">03</span>
                            </div>
                            <div class="col-3 col-md-3">
                                <h5 class="font-serif mb-0">Impacto</h5>
                            </div>
                            <div class="col-7 col-md-8">
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
