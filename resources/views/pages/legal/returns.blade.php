@extends('layouts.app')

@section('title', 'Cambios y devoluciones — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item text-muted-eco">Legal</li>
            <li class="breadcrumb-item active" aria-current="page">Cambios y devoluciones</li>
        </ol>
    </nav>

    {{-- Header --}}
    <header class="mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Documentos legales</p>
        <h1 class="font-serif display-4 mb-2">Cambios y devoluciones</h1>
        <p class="font-mono fs-7 text-muted-eco mb-0">Última actualización: 10 de mayo de 2026</p>
    </header>

    <div class="row g-5">

        {{-- Sidebar --}}
        <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            @include('partials.legal-sidebar')
        </div>

        {{-- Contenido --}}
        <div class="col-lg-9" data-aos="fade-up" data-aos-delay="150">

            {{-- Resumen --}}
            <div class="bg-light rounded p-4 mb-5">
                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">Resumen</p>
                <p class="mb-0">
                    Tienes 30 días desde la entrega para devolver tu pedido si no estás contento.
                    Los productos personalizados no admiten devolución salvo defecto de fábrica.
                </p>
            </div>

            {{-- Pasos --}}
            <h2 class="font-serif display-6 mb-4">Cómo solicitar una devolución</h2>
            @php
                $pasos = [
                    ['01', 'Escríbenos por correo', 'A devoluciones@ecocreations.pe con tu número de orden y la razón. Te respondemos en 24h hábiles.'],
                    ['02', 'Te enviamos la guía', 'Si aplica, te mandamos una guía de OLVA para que dejes el paquete sin pagar nada. Tienes 7 días desde la guía para hacerlo.'],
                    ['03', 'Revisamos y reembolsamos', 'Cuando llega el producto, lo revisamos (2-3 días) y emitimos el reembolso al mismo medio de pago. El banco demora entre 5-10 días hábiles en acreditarlo.'],
                ];
            @endphp
            <div class="d-flex flex-column gap-3 mb-5">
                @foreach ($pasos as $paso)
                    <div class="card border">
                        <div class="card-body p-4 d-flex gap-3 align-items-start">
                            <span class="bg-primary text-light font-mono fw-bold rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 48px; height: 48px;">{{ $paso[0] }}</span>
                            <div>
                                <h3 class="fs-5 fw-semibold mb-1">{{ $paso[1] }}</h3>
                                <p class="text-muted-eco mb-0">{{ $paso[2] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Qué SÍ / qué NO --}}
            <h2 class="font-serif fs-3 mb-3">Qué SÍ y qué NO se devuelve</h2>
            <div class="row g-3">
                {{-- SÍ --}}
                <div class="col-md-6">
                    <div class="card border-success h-100">
                        <div class="card-body p-4">
                            <p class="d-flex align-items-center gap-2 text-success fw-semibold mb-3">
                                <i class="bi bi-check-circle-fill"></i> Sí se devuelve
                            </p>
                            <ul class="text-muted-eco mb-0 ps-3" style="line-height: 1.8;">
                                <li>Productos sin uso, en empaque original</li>
                                <li>Defectos de fábrica (siempre)</li>
                                <li>Equivocaciones nuestras (envío incorrecto)</li>
                                <li>Producto distinto al pedido</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- NO --}}
                <div class="col-md-6">
                    <div class="card border-danger h-100">
                        <div class="card-body p-4">
                            <p class="d-flex align-items-center gap-2 text-danger fw-semibold mb-3">
                                <i class="bi bi-x-circle-fill"></i> No se devuelve
                            </p>
                            <ul class="text-muted-eco mb-0 ps-3" style="line-height: 1.8;">
                                <li>Productos con grabado láser personalizado</li>
                                <li>Productos usados o lavados</li>
                                <li>Devoluciones después de 30 días</li>
                                <li>Sin comprobante de compra</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
