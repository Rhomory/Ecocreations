@extends('layouts.app')

@section('title', 'Pedido Confirmado — ECOCREATIONS')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- Icono de éxito --}}
            <div class="text-center mb-4" data-aos="zoom-in">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary mb-4"
                     style="width: 96px; height: 96px;">
                    <i class="bi bi-check-lg text-light display-4"></i>
                </div>
                <p class="font-mono fs-8 text-accent text-uppercase fw-bold mb-2">—— Pedido confirmado</p>
                <h1 class="font-serif display-4 mb-3">¡Gracias por<br>tu compra!</h1>
                <p class="text-muted-eco mb-0" style="max-width: 480px; margin: 0 auto;">
                    Tu pedido ha sido procesado exitosamente. Te hemos enviado los detalles
                    a tu correo electrónico.
                </p>
            </div>

            {{-- Card de resumen --}}
            <div class="card border" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body p-4">

                    {{-- Número de pedido --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <div>
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Número de pedido</p>
                            <h3 class="font-mono fw-bold fs-4 mb-0">#ECO-{{ str_pad($order ?? 1, 5, '0', STR_PAD_LEFT) }}</h3>
                        </div>
                        <span class="badge bg-success rounded-pill px-3 py-2 font-mono fs-8 fw-bold text-uppercase">
                            <i class="bi bi-check-circle-fill me-1"></i> Confirmado
                        </span>
                    </div>

                    {{-- Detalles --}}
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Fecha del pedido</p>
                            <p class="fw-semibold mb-0">{{ now()->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Método de pago</p>
                            <p class="fw-semibold mb-0"><i class="bi bi-credit-card me-1"></i> Visa •••• 1111</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Envío estimado</p>
                            <p class="fw-semibold mb-0"><i class="bi bi-truck me-1"></i> 3-5 días hábiles</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Dirección de envío</p>
                            <p class="fw-semibold mb-0">Av. Los Pinos 345, Surco, Lima</p>
                        </div>
                    </div>

                    <hr class="opacity-25">

                    {{-- Items --}}
                    @php
                        $items = [
                            (object)['nombre' => 'Botella Andina 600ml', 'variante' => 'Verde Musgo · 600ml', 'cantidad' => 2, 'total' => 99.80],
                            (object)['nombre' => 'Bolsa Tote Orgánica', 'variante' => 'Natural · Grande', 'cantidad' => 1, 'total' => 29.90],
                            (object)['nombre' => 'Set Cubiertos Bambú', 'variante' => 'Natural', 'cantidad' => 1, 'total' => 34.90],
                        ];
                    @endphp

                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-3">Artículos ({{ count($items) }})</p>

                    @foreach ($items as $item)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 48px; height: 48px;">
                                <i class="bi bi-image text-primary opacity-50 fs-7"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0 fs-7">{{ $item->nombre }}</p>
                                <p class="text-muted-eco fs-8 mb-0">{{ $item->variante }} · Qty: {{ $item->cantidad }}</p>
                            </div>
                            <span class="font-mono fw-bold fs-7">S/ {{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach

                    <hr class="opacity-25">

                    {{-- Totales --}}
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted-eco">Subtotal</span>
                        <span class="font-mono">S/ 164.60</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted-eco">Envío</span>
                        <span class="font-mono">S/ 9.90</span>
                    </div>
                    <hr class="opacity-25">
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total pagado</span>
                        <span class="font-mono fw-bold fs-4">S/ 174.50</span>
                    </div>
                </div>
            </div>

            {{-- CTAs --}}
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('catalog.index') }}"
                   class="btn btn-accent rounded-pill px-4 py-3 fw-bold btn-animated">
                    <span class="btn-animated-label">
                        Seguir comprando <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                    </span>
                </a>
                <a href="{{ route('home') }}"
                   class="btn btn-outline-dark rounded-pill px-4 py-3 fw-semibold">
                    Volver al inicio
                </a>
            </div>

            {{-- Nota eco --}}
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-light border rounded-3 p-4 d-inline-block">
                    <i class="bi bi-tree-fill text-primary fs-4 d-block mb-2"></i>
                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Impacto positivo</p>
                    <p class="fw-semibold mb-0">
                        Con esta compra evitaste <span class="text-primary fw-bold">3 productos de plástico</span> de un solo uso 🌿
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
