@extends('layouts.app')

@section('title', 'Sobre nosotros — ECOCREATIONS')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="container py-4 py-lg-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Sobre nosotros</li>
        </ol>
    </nav>

    <div data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-3">—— Nuestra historia</p>
        <h1 class="font-serif display-2 mb-4">Cosas pequeñas<br>que hacen mucho.</h1>
        <p class="text-muted-eco fs-5 mb-0" style="max-width: 68rem;">
            Nacimos en Arequipa en 2020 con una idea simple: dejar el planeta un poquito mejor.
            Diseñamos botellas, bolsas y utensilios eco-amigables que reemplazan plásticos de
            un solo uso, cada uno hecho a mano por talleres peruanos.
        </p>
    </div>

    {{-- Stats --}}
    <div class="row row-cols-2 row-cols-lg-4 g-4 pt-5" data-aos="fade-up" data-aos-delay="100">
        <div class="col">
            <p class="font-serif display-5 mb-1">+12,000</p>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-0">Productos personalizados</p>
        </div>
        <div class="col">
            <p class="font-serif display-5 mb-1">98%</p>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-0">Materiales sostenibles</p>
        </div>
        <div class="col">
            <p class="font-serif display-5 mb-1">24</p>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-0">Talleres aliados · Perú</p>
        </div>
        <div class="col">
            <p class="font-serif display-5 mb-1">5 años</p>
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-0">Desde 2020 · Arequipa</p>
        </div>
    </div>
</section>

{{-- ===================== VALORES ===================== --}}
<section class="bg-light py-5">
    <div class="container py-lg-4">

        <div class="mb-5" data-aos="fade-up">
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Lo que nos mueve</p>
            <h2 class="font-serif display-5">Tres principios que guían cada decisión.</h2>
        </div>

        <div class="row g-4">
            {{-- Valor 1 --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border h-100">
                    <div class="card-body p-4">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;">
                            <i class="bi bi-tree-fill text-light fs-4"></i>
                        </div>
                        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">01 · Materiales</p>
                        <h3 class="font-serif fs-3 mb-2">Origen consciente</h3>
                        <p class="text-muted-eco mb-0">
                            Cada material tiene trazabilidad y certificación de origen sostenible.
                            Trabajamos con proveedores locales que respetan el ecosistema andino.
                        </p>
                    </div>
                </div>
            </div>
            {{-- Valor 2 (destacado, verde) --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card bg-primary border-0 h-100">
                    <div class="card-body p-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                        <p class="font-mono fs-8 text-secondary text-uppercase mb-1">02 · Producción</p>
                        <h3 class="font-serif fs-3 text-light mb-2">Trabajo justo</h3>
                        <p class="text-secondary mb-0">
                            Producimos en talleres peruanos pagando precios justos, sin intermediarios.
                            Cada artesano firma cada pieza que sale al mundo.
                        </p>
                    </div>
                </div>
            </div>
            {{-- Valor 3 --}}
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border h-100">
                    <div class="card-body p-4">
                        <div class="bg-accent rounded d-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;">
                            <i class="bi bi-flower1 text-light fs-4"></i>
                        </div>
                        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">03 · Impacto</p>
                        <h3 class="font-serif fs-3 mb-2">Devolvemos al planeta</h3>
                        <p class="text-muted-eco mb-0">
                            El 1% de cada venta financia proyectos de reforestación en la Amazonía
                            peruana. Hasta hoy plantamos 8,400 árboles nativos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== HISTORIA ===================== --}}
<section class="container py-5">
    <div class="row g-5 align-items-start py-lg-4">

        {{-- Imagen --}}
        <div class="col-lg-5" data-aos="fade-right">
            <div class="bg-secondary rounded d-flex flex-column justify-content-between p-4"
                style="min-height: 520px;">
                <i class="bi bi-image fs-1 text-light opacity-50"></i>
                <p class="font-mono fs-8 text-uppercase mb-0 text-light opacity-75">
                    Nuestro taller · 2020
                </p>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="col-lg-7" data-aos="fade-left">
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Cómo llegamos aquí</p>
            <h2 class="font-serif display-5 mb-4">Cinco años<br>construyendo algo verde.</h2>

            <div class="border-top">
                @php
                    $hitos = [
                        ['2020', 'El comienzo', 'Lo que empezó como un proyecto familiar para reducir el plástico en casa se transformó en marca.'],
                        ['2022', 'Primera línea de regalos corporativos', 'Empresas peruanas empezaron a usar nuestras botellas como regalo de fin de año.'],
                        ['2024', 'Programa de reforestación', 'Junto a AIDER plantamos los primeros 5,000 árboles en la región Madre de Dios.'],
                        ['2026', 'Lanzamos la tienda online', 'Después de cinco años, abrimos el catálogo al público con personalización en cada producto.'],
                    ];
                @endphp
                @foreach ($hitos as $hito)
                    <div class="d-flex gap-4 py-3 border-bottom">
                        <span class="font-mono fw-bold text-accent flex-shrink-0">{{ $hito[0] }}</span>
                        <div>
                            <p class="fw-semibold mb-1">{{ $hito[1] }}</p>
                            <p class="text-muted-eco fs-7 mb-0">{{ $hito[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===================== EQUIPO ===================== --}}
<section class="container py-5">

    <div class="text-center mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— El equipo</p>
        <h2 class="font-serif display-5">Manos detrás de cada pieza.</h2>
    </div>

    <div class="row row-cols-2 row-cols-lg-4 g-4">
        @php
            $equipo = [
                ['Mariana Quispe', 'Fundadora · Diseño', 'Diseñadora industrial. Cinco años creando productos que cuidan.', 'bg-secondary'],
                ['Diego Salazar', 'Operaciones · Talleres', 'Coordina con cada artesano. Conoce a todos por su nombre.', 'bg-accent'],
                ['Camila Ruiz', 'Comunidad · Clientes', 'Tu primera respuesta cuando escribes. Café y plantas.', 'bg-primary'],
                ['Andrés Loayza', 'Impacto · Reforestación', 'Lleva la cuenta de cada árbol plantado. Ingeniero forestal.', 'bg-light'],
            ];
        @endphp
        @foreach ($equipo as $i => $miembro)
            <div class="col" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="{{ $miembro[3] }} rounded d-flex align-items-center justify-content-center mb-3"
                    style="height: 280px;">
                    <i class="bi bi-person fs-1 {{ $miembro[3] === 'bg-light' ? 'text-muted-eco' : 'text-light' }} opacity-75"></i>
                </div>
                <p class="fw-semibold mb-0">{{ $miembro[0] }}</p>
                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">{{ $miembro[1] }}</p>
                <p class="text-muted-eco fs-7 mb-0">{{ $miembro[2] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ===================== IMPACTO ===================== --}}
<section class="bg-primary py-5">
    <div class="container py-lg-4">

        <div class="mb-5" data-aos="fade-up">
            <p class="font-mono fs-8 text-secondary text-uppercase mb-2">—— Impacto medible</p>
            <h2 class="font-serif display-5 text-light">Hasta hoy hemos…</h2>
        </div>

        <div class="row g-4">
            @php
                $impacto = [
                    ['8,400', 'Árboles nativos plantados', 'En la Amazonía peruana junto a AIDER, certificado por el SERFOR.'],
                    ['3.2 ton', 'Plástico evitado', 'Cada botella reutilizable reemplaza ~150 botellas plásticas por año.'],
                    ['24', 'Familias artesanas', 'Trabajamos directamente con talleres en Arequipa, Cusco, Lima y Puno.'],
                ];
            @endphp
            @foreach ($impacto as $i => $dato)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="border-top border-secondary pt-4">
                        <p class="font-serif display-4 text-light mb-2">{{ $dato[0] }}</p>
                        <p class="font-mono fs-8 text-secondary text-uppercase mb-2">{{ $dato[1] }}</p>
                        <p class="text-secondary fs-7 mb-0">{{ $dato[2] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="container py-5 text-center" data-aos="zoom-in">
    <div class="py-lg-4">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-3">—— ¿Listo para empezar?</p>
        <h2 class="font-serif display-3 mb-3">Cada compra siembra futuro.</h2>
        <p class="text-muted-eco fs-5 mx-auto mb-4" style="max-width: 38rem;">
            Compra un producto eco hecho a tu medida o escríbenos para pedidos corporativos.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('catalog.index') }}" class="btn btn-accent rounded-pill px-4 btn-animated">
                <span class="btn-animated-label">
                    Ver catálogo
                    <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                </span>
            </a>
            <a href="{{ route('page.contact') }}" class="btn btn-outline-dark rounded-pill px-4">
                Contáctanos
            </a>
        </div>
    </div>
</section>

@endsection
