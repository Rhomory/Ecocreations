@extends('layouts.app')

@section('title', 'Checkout — ECOCREATIONS')

@section('content')

    {{-- ===== Progress Steps ===== --}}
    <div class="border-bottom" data-aos="fade-down">
        <div class="container py-3">
            <div class="d-flex justify-content-center align-items-center gap-2 gap-md-3">
                <a href="{{ route('cart.index') }}"
                    class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                    <span class="d-flex align-items-center justify-content-center rounded-circle border border-dark"
                        style="width: 28px; height: 28px;">
                        <i class="bi bi-check2 fs-7"></i>
                    </span>
                    <span class="font-mono fs-8 fw-bold text-uppercase d-none d-sm-inline">Carrito</span>
                </a>
                <div class="border-top" style="width: 40px; border-color: var(--bs-dark) !important;"></div>
                <span class="d-flex align-items-center gap-2">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-dark text-light"
                        style="width: 28px; height: 28px;">
                        <span class="font-mono fs-8 fw-bold">2</span>
                    </span>
                    <span class="font-mono fs-8 fw-bold text-uppercase d-none d-sm-inline">Datos y pago</span>
                </span>
                <div class="border-top opacity-25" style="width: 40px;"></div>
                <span class="d-flex align-items-center gap-2 opacity-50">
                    <span class="d-flex align-items-center justify-content-center rounded-circle border"
                        style="width: 28px; height: 28px;">
                        <span class="font-mono fs-8">3</span>
                    </span>
                    <span class="font-mono fs-8 text-uppercase d-none d-sm-inline">Confirmación</span>
                </span>
            </div>
        </div>
    </div>

    <div class="container py-4 py-lg-5">

        {{-- Header --}}
        <div class="mb-4 mb-lg-5" data-aos="fade-up">
            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Paso 2 de 3 · Checkout</p>
            <h1 class="font-serif display-4 mb-0">Finalizá tu pedido</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 rounded-3" data-aos="fade-up">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                @foreach ($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.process') }}" id="checkoutForm">
            @csrf
            <div class="row g-4 g-lg-5">

                {{-- ===== Columna Izquierda: Formularios ===== --}}
                <div class="col-lg-7">

                    {{-- Sección: Datos de contacto --}}
                    <div class="card border mb-4" data-aos="fade-up">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <span
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light"
                                    style="width: 32px; height: 32px;">
                                    <span class="font-mono fw-bold fs-8">01</span>
                                </span>
                                <h2 class="font-serif fs-4 mb-0">Datos de contacto</h2>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nombre"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Nombre
                                        completo</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="nombre" name="nombre"
                                        placeholder="Tu nombre"
                                        value="{{ old('nombre', auth()->user()?->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Teléfono</label>
                                    <input type="tel" class="form-control py-2 rounded-2" id="telefono" name="telefono"
                                        placeholder="999 999 999"
                                        value="{{ old('telefono', auth()->user()?->clientProfile?->telefono) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="email"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Email</label>
                                    <input type="email" class="form-control py-2 rounded-2" id="email" name="email"
                                        placeholder="tu@correo.com"
                                        value="{{ old('email', auth()->user()?->email) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sección: Dirección de envío --}}
                    <div class="card border mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <span
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light"
                                    style="width: 32px; height: 32px;">
                                    <span class="font-mono fw-bold fs-8">02</span>
                                </span>
                                <h2 class="font-serif fs-4 mb-0">Dirección de envío</h2>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="calle"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Calle /
                                        Avenida</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="calle" name="calle"
                                        placeholder="Av. Los Pinos"
                                        value="{{ old('calle', $direccionPrincipal?->calle) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="numero"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Número</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="numero" name="numero"
                                        placeholder="345"
                                        value="{{ old('numero', $direccionPrincipal?->numero) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="referencia"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Referencia</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="referencia"
                                        name="referencia" placeholder="Frente al parque, casa color crema"
                                        value="{{ old('referencia', $direccionPrincipal?->referencia) }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="distrito"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Distrito</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="distrito"
                                        name="distrito" placeholder="Surco"
                                        value="{{ old('distrito', $direccionPrincipal?->distrito) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="provincia"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Provincia</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="provincia"
                                        name="provincia" placeholder="Lima"
                                        value="{{ old('provincia', $direccionPrincipal?->provincia ?? 'Lima') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="departamento"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Departamento</label>
                                    @php
                                        $dptos = [
                                            'Lima',
                                            'Arequipa',
                                            'Cusco',
                                            'La Libertad',
                                            'Piura',
                                            'Lambayeque',
                                            'Junín',
                                            'Cajamarca',
                                            'Áncash',
                                            'Ica',
                                        ];
                                        $dptoSeleccionado = old(
                                            'departamento',
                                            $direccionPrincipal?->departamento ?? 'Lima',
                                        );
                                    @endphp
                                    <select class="form-select py-2 rounded-2" id="departamento" name="departamento"
                                        required>
                                        @foreach ($dptos as $dpto)
                                            <option value="{{ $dpto }}" @selected($dpto === $dptoSeleccionado)>{{ $dpto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="codigo_postal"
                                        class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Código
                                        Postal</label>
                                    <input type="text" class="form-control py-2 rounded-2" id="codigo_postal"
                                        name="codigo_postal" placeholder="15023"
                                        value="{{ old('codigo_postal', $direccionPrincipal?->codigo_postal) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sección: Método de envío --}}
                    <div class="card border mb-4" data-aos="fade-up" data-aos-delay="150">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <span
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light"
                                    style="width: 32px; height: 32px;">
                                    <span class="font-mono fw-bold fs-8">03</span>
                                </span>
                                <h2 class="font-serif fs-4 mb-0">Método de envío</h2>
                            </div>

                            <div class="d-flex flex-column gap-3" id="shippingOptions">
                                @php
                                    $opcionesEnvio = [
                                        [
                                            'val' => 'estandar',
                                            'title' => 'Envío estándar',
                                            'sub' => '3-5 días hábiles · Lima Metropolitana',
                                            'precio' => 9.9,
                                        ],
                                        [
                                            'val' => 'express',
                                            'title' => 'Envío express',
                                            'sub' => '24-48 horas · Lima Metropolitana',
                                            'precio' => 19.9,
                                        ],
                                        [
                                            'val' => 'recojo',
                                            'title' => 'Recojo en tienda',
                                            'sub' => 'Disponible en 24h · Surco, Lima',
                                            'precio' => 0,
                                        ],
                                    ];
                                    $envioActivo = old('envio', 'estandar');
                                @endphp

                                @foreach ($opcionesEnvio as $opt)
                                    <label
                                        class="d-flex align-items-center gap-3 p-3 border rounded-3 shipping-option {{ $envioActivo === $opt['val'] ? 'border-dark shadow-sm' : '' }}"
                                        style="cursor: pointer;">
                                        <input type="radio" class="form-check-input mt-0" name="envio"
                                            value="{{ $opt['val'] }}" data-precio="{{ $opt['precio'] }}"
                                            @checked($envioActivo === $opt['val'])>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block">{{ $opt['title'] }}</span>
                                            <span class="font-mono fs-8 text-muted-eco">{{ $opt['sub'] }}</span>
                                        </div>
                                        <span
                                            class="font-mono fw-bold {{ $opt['precio'] == 0 ? 'text-success' : '' }}">
                                            {{ $opt['precio'] == 0 ? 'Gratis' : 'S/ ' . number_format($opt['precio'], 2) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Sección: Método de pago --}}
                    <div class="card border" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <span
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light"
                                    style="width: 32px; height: 32px;">
                                    <span class="font-mono fw-bold fs-8">04</span>
                                </span>
                                <h2 class="font-serif fs-4 mb-0">Método de pago</h2>
                            </div>

                            {{-- Tabs de pago --}}
                            <ul class="nav nav-pills nav-justified mb-4 p-1 rounded-pill" id="paymentTabs"
                                style="background-color: #E8E2D4;" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link active rounded-pill text-dark fw-semibold font-mono fs-7 py-2"
                                        data-metodo="niubiz" data-bs-toggle="tab" data-bs-target="#card-pane"
                                        type="button" role="tab">
                                        <i class="bi bi-credit-card me-1"></i> Tarjeta
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill text-dark fw-semibold font-mono fs-7 py-2"
                                        data-metodo="yape" data-bs-toggle="tab" data-bs-target="#yape-pane"
                                        type="button" role="tab">
                                        Yape / Plin
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill text-dark fw-semibold font-mono fs-7 py-2"
                                        data-metodo="cod" data-bs-toggle="tab" data-bs-target="#cod-pane"
                                        type="button" role="tab">
                                        Contraentrega
                                    </button>
                                </li>
                            </ul>

                            <input type="hidden" name="metodo_pago" id="metodoPagoInput"
                                value="{{ old('metodo_pago', 'niubiz') }}">

                            <style>
                                #paymentTabs .nav-link.active {
                                    background-color: #1F1B16;
                                    color: #fff !important;
                                }
                            </style>

                            <div class="tab-content">
                                {{-- Tab Tarjeta --}}
                                <div class="tab-pane fade show active" id="card-pane" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="card_number"
                                                class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Número
                                                de tarjeta</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control py-2 rounded-2 pe-5"
                                                    id="card_number" placeholder="4111 1111 1111 1111"
                                                    maxlength="19">
                                                <i
                                                    class="bi bi-credit-card-2-front position-absolute top-50 end-0 translate-middle-y me-3 text-muted-eco"></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="card_name"
                                                class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Nombre
                                                en la tarjeta</label>
                                            <input type="text" class="form-control py-2 rounded-2" id="card_name"
                                                placeholder="BRAYAN DEVELOPER">
                                        </div>
                                        <div class="col-6">
                                            <label for="card_exp"
                                                class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Vencimiento</label>
                                            <input type="text" class="form-control py-2 rounded-2" id="card_exp"
                                                placeholder="MM/AA" maxlength="5">
                                        </div>
                                        <div class="col-6">
                                            <label for="card_cvv"
                                                class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">CVV</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control py-2 rounded-2 pe-5"
                                                    id="card_cvv" placeholder="•••" maxlength="4">
                                                <i
                                                    class="bi bi-lock-fill position-absolute top-50 end-0 translate-middle-y me-3 text-muted-eco"></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-muted-eco font-mono fs-8 mb-0">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Modo demo: usá cualquier número, no se hace cobro real.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab Yape --}}
                                <div class="tab-pane fade" id="yape-pane" role="tabpanel">
                                    <div class="text-center py-4">
                                        <div class="bg-light border rounded-3 p-4 d-inline-block mb-3">
                                            <i class="bi bi-phone fs-1 text-primary"></i>
                                        </div>
                                        <h5 class="font-serif mb-2">Pago con Yape o Plin</h5>
                                        <p class="text-muted-eco fs-7 mb-0">
                                            Al confirmar, te enviaremos el número y código QR<br>para completar tu pago
                                            desde la app.
                                        </p>
                                    </div>
                                </div>

                                {{-- Tab Contraentrega --}}
                                <div class="tab-pane fade" id="cod-pane" role="tabpanel">
                                    <div class="bg-light rounded-3 p-4">
                                        <h5 class="font-serif mb-2">
                                            <i class="bi bi-cash-stack me-2 text-primary"></i> Pagás cuando recibís
                                        </h5>
                                        <p class="text-muted-eco mb-2">
                                            Coordiná el pago en efectivo con nuestro repartidor al momento de la entrega.
                                        </p>
                                        <p class="font-mono fs-8 text-muted-eco mb-0">
                                            <i class="bi bi-info-circle me-1"></i> Sólo disponible para Lima Metropolitana.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="notas"
                                    class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Notas para el
                                    pedido (opcional)</label>
                                <textarea name="notas" id="notas" rows="2" class="form-control rounded-2"
                                    placeholder="Indicaciones de entrega, horario preferido, etc.">{{ old('notas') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== Columna Derecha: Resumen del Pedido (dark, fiel al .pen) ===== --}}
                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-dark text-light rounded-3 sticky-lg-top p-4" style="top: 6rem;">
                        <p class="font-mono fs-8 text-uppercase mb-3 mb-lg-4" style="letter-spacing: 0.08em; opacity: 0.6;">Resumen</p>

                        {{-- Items mini --}}
                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach ($items as $item)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded flex-shrink-0 position-relative overflow-hidden"
                                        style="width: 56px; height: 56px; background-color: rgba(255,255,255,0.08);">
                                        <x-cloud-img :src="$item->imagen" :alt="$item->nombre"
                                            :w="112" :h="112" crop="fill"
                                            class="w-100 h-100" style="object-fit: cover;" />
                                        <span
                                            class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-accent text-light font-mono"
                                            style="font-size: 0.6rem; z-index:1;">
                                            {{ $item->cantidad }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="fw-semibold mb-0 fs-7 text-truncate">{{ $item->nombre }}</p>
                                        @if ($item->variante)
                                            <p class="font-mono fs-8 mb-0 opacity-75">{{ $item->variante }}</p>
                                        @endif
                                        @if ($item->grabado)
                                            <p class="font-mono fs-8 mb-0 text-accent">
                                                <i class="bi bi-pencil-fill me-1"></i>{{ $item->grabado }}
                                            </p>
                                        @endif
                                    </div>
                                    <span class="font-mono fw-bold fs-7 flex-shrink-0">
                                        S/ {{ number_format($item->total_linea, 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-top opacity-25 my-3"></div>

                        {{-- Totales --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span class="opacity-75">Subtotal</span>
                            <span class="font-mono fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="opacity-75">Envío</span>
                            <span class="font-mono fw-semibold" id="resumenEnvio">S/
                                {{ number_format($envio, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="opacity-75">Descuento</span>
                            <span class="font-mono fw-semibold text-success">- S/ 0.00</span>
                        </div>

                        <div class="border-top opacity-25 my-3"></div>

                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <span class="fw-bold">Total a pagar</span>
                            <span class="font-serif fw-bold" id="resumenTotal" style="font-size: 2rem; line-height: 1;">
                                S/ {{ number_format($total, 2) }}
                            </span>
                        </div>

                        {{-- CTA --}}
                        <button type="submit"
                            class="btn btn-accent btn-lg w-100 rounded-pill font-mono fw-bold d-flex align-items-center justify-content-center gap-2 py-3 btn-animated"
                            id="btnSubmitCheckout">
                            <span class="btn-animated-label">
                                <i class="bi bi-lock-fill me-1"></i>
                                Pagar <span id="btnPagarTotal">S/ {{ number_format($total, 2) }}</span>
                                <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                            </span>
                        </button>

                        <p class="text-center font-mono fs-8 mt-3 mb-0 opacity-75">
                            <i class="bi bi-shield-lock-fill me-1"></i> Pago seguro · SSL 256-bit
                        </p>

                        {{-- Trust --}}
                        <div class="d-flex justify-content-center gap-4 mt-4 pt-3 border-top border-secondary">
                            <div class="text-center">
                                <i class="bi bi-shield-check text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 opacity-75">SSL 256</span>
                            </div>
                            <div class="text-center">
                                <i class="bi bi-arrow-repeat text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 opacity-75">Devolución 30d</span>
                            </div>
                            <div class="text-center">
                                <i class="bi bi-tree text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 opacity-75">100% Eco</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            (function () {
                const SUBTOTAL = {{ $subtotal }};
                const inputMetodo = document.getElementById('metodoPagoInput');
                const resumenEnvio = document.getElementById('resumenEnvio');
                const resumenTotal = document.getElementById('resumenTotal');
                const btnPagarTotal = document.getElementById('btnPagarTotal');

                function fmt(n) { return 'S/ ' + n.toFixed(2); }

                function recalcular() {
                    const radio = document.querySelector('input[name="envio"]:checked');
                    const envio = radio ? parseFloat(radio.dataset.precio) : 0;
                    const total = SUBTOTAL + envio;
                    if (resumenEnvio) resumenEnvio.textContent = envio === 0 ? 'Gratis' : fmt(envio);
                    if (resumenTotal) resumenTotal.textContent = fmt(total);
                    if (btnPagarTotal) btnPagarTotal.textContent = fmt(total);
                }

                // Mantener marcada la opción de envío visualmente
                document.querySelectorAll('.shipping-option input').forEach(r => {
                    r.addEventListener('change', () => {
                        document.querySelectorAll('.shipping-option').forEach(l => {
                            l.classList.toggle('border-dark', l.contains(document.querySelector('input[name="envio"]:checked')));
                            l.classList.toggle('shadow-sm', l.contains(document.querySelector('input[name="envio"]:checked')));
                        });
                        recalcular();
                    });
                });

                // Tabs de pago → setear el método en input hidden
                document.querySelectorAll('#paymentTabs button[data-metodo]').forEach(btn => {
                    btn.addEventListener('shown.bs.tab', () => {
                        if (inputMetodo) inputMetodo.value = btn.dataset.metodo;
                    });
                });
            })();
        </script>
    @endpush

@endsection
