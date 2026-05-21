@extends('layouts.app')

@section('title', 'Envíos y entregas — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item text-muted-eco">Legal</li>
            <li class="breadcrumb-item active" aria-current="page">Envíos y entregas</li>
        </ol>
    </nav>

    {{-- Header --}}
    <header class="mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Documentos legales</p>
        <h1 class="font-serif display-4 mb-2">Envíos y entregas</h1>
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
                    Arequipa: 24-48h hábiles. Otras provincias: 3-7 días hábiles.
                    Envío gratis sobre S/180. Te enviamos código de seguimiento por correo.
                </p>
            </div>

            {{-- Tabla de tarifas --}}
            <h2 class="font-serif display-6 mb-3">Tarifas y tiempos</h2>
            <div class="table-responsive mb-5">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="font-mono fs-8 text-uppercase text-muted-eco fw-semibold">Zona</th>
                            <th class="font-mono fs-8 text-uppercase text-muted-eco fw-semibold">Tiempo</th>
                            <th class="font-mono fs-8 text-uppercase text-muted-eco fw-semibold">Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Arequipa Metropolitana</td>
                            <td class="text-muted-eco">24-48 horas hábiles</td>
                            <td class="font-mono fw-semibold">S/ 12.00</td>
                        </tr>
                        <tr>
                            <td>Provincias (capital)</td>
                            <td class="text-muted-eco">3-5 días hábiles</td>
                            <td class="font-mono fw-semibold">S/ 18.00</td>
                        </tr>
                        <tr>
                            <td>Provincias (otras)</td>
                            <td class="text-muted-eco">5-7 días hábiles</td>
                            <td class="font-mono fw-semibold">S/ 22.00</td>
                        </tr>
                        <tr>
                            <td class="text-accent fw-semibold">Compras +S/ 180</td>
                            <td class="text-muted-eco">Tiempo normal</td>
                            <td class="font-mono fw-bold text-accent">GRATIS</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Secciones --}}
            @php
                $secciones = [
                    ['01. Cómo procesamos tu pedido', 'Una vez confirmado el pago, preparamos tu pedido en 24-48h hábiles. Si tiene personalización, suma 2-3 días para producción. Cuando sale del taller te llega un correo con el código de seguimiento.'],
                    ['02. Empresas de envío', 'Trabajamos con OLVA Courier (Arequipa y todo Perú) y Shalom (provincias). Para envíos express en Arequipa usamos Cabify Envíos. La empresa exacta depende de tu zona.'],
                    ['03. ¿No estabas en casa?', 'El courier deja un aviso e intenta nuevamente al día siguiente. Después del tercer intento, el paquete vuelve a nuestra base. Te avisamos para coordinar reenvío sin costo extra.'],
                ];
            @endphp

            @foreach ($secciones as $sec)
                <section class="mb-4">
                    <h2 class="font-serif fs-3 mb-2">{{ $sec[0] }}</h2>
                    <p class="text-muted-eco mb-0" style="line-height: 1.7;">{{ $sec[1] }}</p>
                </section>
            @endforeach

        </div>
    </div>
</div>
@endsection
