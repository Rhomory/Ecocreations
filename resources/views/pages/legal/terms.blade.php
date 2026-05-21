@extends('layouts.app')

@section('title', 'Términos y condiciones — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item text-muted-eco">Legal</li>
            <li class="breadcrumb-item active" aria-current="page">Términos y condiciones</li>
        </ol>
    </nav>

    {{-- Header --}}
    <header class="mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Documentos legales</p>
        <h1 class="font-serif display-4 mb-2">Términos y condiciones</h1>
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
                    Al usar ECOCREATIONS.pe aceptas estos términos. Si no estás de acuerdo,
                    no uses la página. Lo escribimos en lenguaje claro porque creemos en la
                    transparencia.
                </p>
            </div>

            {{-- Secciones --}}
            @php
                $secciones = [
                    ['01. Quiénes somos', 'ECOCREATIONS S.A.C. es una empresa peruana con RUC 20601234567, domiciliada en Arequipa, Perú. Vendemos productos eco-amigables personalizables a través de ecocreations.pe.'],
                    ['02. Cómo comprar', 'Para comprar tienes que crear una cuenta con un correo válido. El pedido se confirma cuando el pago se procesa correctamente vía Niubiz. Una vez confirmado, recibes un correo con los detalles y el código de seguimiento.'],
                    ['03. Personalización', 'Los productos personalizados (grabado láser, color, talla) no se aceptan en devolución salvo defecto de fábrica. Revisa bien tu pedido antes de confirmar. Te enviamos un mockup para aprobar antes de producir.'],
                    ['04. Precios y pagos', 'Todos los precios están en Soles peruanos (S/) e incluyen IGV. Aceptamos tarjetas de crédito y débito Visa, Mastercard, American Express y Diners vía Niubiz. No almacenamos datos de tu tarjeta — todo se procesa en el lado de Niubiz.'],
                    ['05. Propiedad intelectual', 'El nombre ECOCREATIONS, el logotipo y los diseños de los productos son propiedad de la empresa. No puedes reproducirlos sin autorización escrita. Las marcas que personalizas tú siguen siendo tuyas.'],
                    ['06. Modificaciones', 'Podemos actualizar estos términos en cualquier momento. Si lo hacemos, actualizamos la fecha al inicio de este documento. Si los cambios son sustanciales te avisamos por correo.'],
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
