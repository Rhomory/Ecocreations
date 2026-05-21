@extends('layouts.app')

@section('title', 'Política de privacidad — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item text-muted-eco">Legal</li>
            <li class="breadcrumb-item active" aria-current="page">Política de privacidad</li>
        </ol>
    </nav>

    {{-- Header --}}
    <header class="mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Documentos legales</p>
        <h1 class="font-serif display-4 mb-2">Política de privacidad</h1>
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
                    Recolectamos solo los datos necesarios para procesar tu compra. No vendemos
                    información a terceros. Puedes pedir borrar tu cuenta en cualquier momento.
                </p>
            </div>

            {{-- Secciones --}}
            @php
                $secciones = [
                    ['01. Qué datos recolectamos', 'Nombre, correo, dirección de envío, teléfono y los datos necesarios para emitir comprobante (DNI/RUC). Los datos de pago los procesa Niubiz directamente — no los vemos ni los guardamos.'],
                    ['02. Para qué los usamos', 'Procesar tu pedido, enviarlo a tu dirección, emitir comprobante, responder consultas y enviarte novedades si estás suscrito al newsletter. Nada más.'],
                    ['03. Con quién compartimos', 'Solo con las empresas de envío (OLVA, Shalom, Cruz del Sur) para entregar tu pedido, y con Niubiz para procesar el pago. No compartimos tus datos con anunciantes ni redes sociales.'],
                    ['04. Cookies', 'Usamos cookies para mantener tu sesión iniciada y recordar tu carrito. No usamos cookies de tracking publicitario.'],
                    ['05. Tus derechos', 'Puedes acceder, modificar o pedir borrar tus datos en cualquier momento escribiéndonos a privacidad@ecocreations.pe. Respondemos en máximo 15 días hábiles, según la Ley 29733 de Protección de Datos Personales del Perú.'],
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
