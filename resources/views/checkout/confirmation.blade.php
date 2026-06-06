@extends('layouts.app')

@section('title', 'Pedido confirmado — ECOCREATIONS')

@section('content')
    @php
        $estadoConfirmado = in_array($order->estado, ['pagado', 'preparando', 'enviado', 'entregado']);
        $totalUnidades = $order->items->sum('cantidad');
    @endphp

    {{-- Progress Steps (todos completos) --}}
    <div class="border-bottom" data-aos="fade-down">
        <div class="container py-3">
            <div class="d-flex justify-content-center align-items-center gap-2 gap-md-3">
                @foreach (['Carrito', 'Datos y pago', 'Confirmación'] as $i => $step)
                    <span class="d-flex align-items-center gap-2 {{ $i === 2 ? '' : 'text-dark' }}">
                        <span
                            class="d-flex align-items-center justify-content-center rounded-circle {{ $i === 2 ? 'bg-primary text-light' : 'bg-dark text-light' }}"
                            style="width: 28px; height: 28px;">
                            <i class="bi bi-check2 fs-7"></i>
                        </span>
                        <span class="font-mono fs-8 fw-bold text-uppercase d-none d-sm-inline">{{ $step }}</span>
                    </span>
                    @if (!$loop->last)
                        <div class="border-top" style="width: 40px; border-color: var(--bs-dark) !important;"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Icono de éxito --}}
                <div class="text-center mb-4 mb-lg-5" data-aos="zoom-in">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary mb-4"
                        style="width: 96px; height: 96px;">
                        <i class="bi bi-check-lg text-light display-4"></i>
                    </div>
                    <p class="font-mono fs-8 text-accent text-uppercase fw-bold mb-2">—— Pedido confirmado</p>
                    <h1 class="font-serif display-4 mb-3">¡Gracias por<br>tu compra, {{ explode(' ', $order->user->name)[0] ?? 'cliente' }}!</h1>
                    <p class="text-muted-eco mb-0 mx-auto" style="max-width: 480px;">
                        Tu pedido fue procesado correctamente. Te enviamos los detalles a
                        <strong>{{ $order->user->email }}</strong>.
                    </p>
                </div>

                {{-- Card de resumen --}}
                <div class="card border" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body p-4 p-lg-5">

                        {{-- Número de pedido --}}
                        <div
                            class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 pb-3 border-bottom">
                            <div>
                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Número de pedido</p>
                                <h3 class="font-mono fw-bold fs-4 mb-0">#{{ $order->numero_orden }}</h3>
                            </div>
                            <span
                                class="badge {{ $estadoConfirmado ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-3 py-2 font-mono fs-8 fw-bold text-uppercase">
                                <i class="bi {{ $estadoConfirmado ? 'bi-check-circle-fill' : 'bi-clock-fill' }} me-1"></i>
                                {{ ucfirst($order->estado) }}
                            </span>
                        </div>

                        {{-- Detalles --}}
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Fecha del pedido</p>
                                <p class="fw-semibold mb-0">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Método de pago</p>
                                <p class="fw-semibold mb-0">
                                    <i class="bi bi-credit-card me-1"></i>
                                    {{ $order->paymentMethod?->nombre ?? 'Tarjeta' }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Envío estimado</p>
                                <p class="fw-semibold mb-0"><i class="bi bi-truck me-1"></i> 3-5 días hábiles</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Dirección de envío</p>
                                <p class="fw-semibold mb-0">
                                    {{ $order->address->calle }} {{ $order->address->numero }},
                                    {{ $order->address->distrito }}, {{ $order->address->departamento }}
                                </p>
                            </div>
                        </div>

                        <div class="border-top opacity-25 my-3"></div>

                        {{-- Items --}}
                        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-3">Artículos
                            ({{ $order->items->count() }})</p>

                        @foreach ($order->items as $item)
                            @php
                                $variant = $item->variant;
                                $variantStr = $variant
                                    ? collect([$variant->color, $variant->tamano])->filter()->implode(' · ')
                                    : '';
                                $grabado = $item->customization['grabado'] ?? null;
                            @endphp
                            <div class="d-flex align-items-center gap-3 mb-3">
                                @php
                                    $imgItem = $item->variant?->product?->images->sortByDesc('es_principal')->first()?->ruta;
                                @endphp
                                <div class="rounded flex-shrink-0 position-relative overflow-hidden bg-secondary"
                                    style="width: 56px; height: 56px;">
                                    <x-cloud-img :src="$imgItem" :alt="$item->nombre_producto"
                                        :w="112" :h="112" crop="fill"
                                        class="w-100 h-100" style="object-fit: cover;" />
                                    <span
                                        class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-dark font-mono"
                                        style="font-size: 0.6rem; z-index:1;">{{ $item->cantidad }}</span>
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <p class="fw-semibold mb-0 fs-7">{{ $item->nombre_producto }}</p>
                                    @if ($variantStr)
                                        <p class="text-muted-eco fs-8 mb-0">{{ $variantStr }}</p>
                                    @endif
                                    @if ($grabado)
                                        <span class="badge bg-primary font-mono fs-8 mt-1">
                                            <i class="bi bi-pencil-fill me-1"></i>{{ $grabado }}
                                        </span>
                                    @endif
                                </div>
                                <span class="font-mono fw-bold fs-7 text-end">
                                    S/ {{ number_format($item->subtotal, 2) }}
                                </span>
                            </div>
                        @endforeach

                        <div class="border-top opacity-25 my-3"></div>

                        {{-- Totales --}}
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted-eco">Subtotal</span>
                            <span class="font-mono">S/ {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted-eco">Envío</span>
                            <span class="font-mono">S/ {{ number_format($order->envio, 2) }}</span>
                        </div>
                        @if ($order->descuento > 0)
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted-eco">Descuento</span>
                                <span class="font-mono text-success">- S/ {{ number_format($order->descuento, 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted-eco font-mono fs-8">IGV incluido</span>
                            <span class="font-mono fs-8 text-muted-eco">S/ {{ number_format($order->igv, 2) }}</span>
                        </div>
                        <div class="border-top opacity-25 my-3"></div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold fs-5">Total pagado</span>
                            <span class="font-mono fw-bold fs-4">S/ {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- CTAs --}}
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4" data-aos="fade-up"
                    data-aos-delay="300">
                    <a href="{{ route('catalog.index') }}"
                        class="btn btn-accent rounded-pill px-4 py-3 fw-bold btn-animated">
                        <span class="btn-animated-label">
                            Seguir comprando <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                        </span>
                    </a>
                    <a href="{{ route('account.orders') }}"
                        class="btn btn-outline-dark rounded-pill px-4 py-3 fw-semibold">
                        <i class="bi bi-bag me-1"></i> Ver mis pedidos
                    </a>
                </div>

                {{-- Nota eco --}}
                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-light border rounded-3 p-4 d-inline-block">
                        <i class="bi bi-tree-fill text-primary fs-4 d-block mb-2"></i>
                        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Impacto positivo</p>
                        <p class="fw-semibold mb-0">
                            Con esta compra evitaste
                            <span class="text-primary fw-bold">{{ $totalUnidades }} productos de plástico</span>
                            de un solo uso
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
