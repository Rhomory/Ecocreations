@extends('layouts.app')

@section('title', 'Checkout — ECOCREATIONS')

@section('content')

{{-- ===== Progress Steps ===== --}}
<div class="border-bottom" data-aos="fade-down">
    <div class="container py-3">
        <div class="d-flex justify-content-center align-items-center gap-2 gap-md-3">
            <a href="{{ route('cart.index') }}" class="d-flex align-items-center gap-2 text-decoration-none text-muted-eco">
                <span class="d-flex align-items-center justify-content-center rounded-circle border border-dark text-dark" style="width: 28px; height: 28px;">
                    <i class="bi bi-check2 fs-7"></i>
                </span>
                <span class="font-mono fs-8 fw-bold text-uppercase d-none d-sm-inline text-dark">Carrito</span>
            </a>
            <div class="border-top flex-grow-0" style="width: 40px; border-color: var(--bs-dark) !important;"></div>
            <span class="d-flex align-items-center gap-2">
                <span class="d-flex align-items-center justify-content-center rounded-circle bg-dark text-light" style="width: 28px; height: 28px;">
                    <span class="font-mono fs-8 fw-bold">2</span>
                </span>
                <span class="font-mono fs-8 fw-bold text-uppercase d-none d-sm-inline">Datos y pago</span>
            </span>
            <div class="border-top flex-grow-0 opacity-25" style="width: 40px;"></div>
            <span class="d-flex align-items-center gap-2 opacity-50">
                <span class="d-flex align-items-center justify-content-center rounded-circle border" style="width: 28px; height: 28px;">
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
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Paso 2 de 3</p>
        <h1 class="font-serif display-4 mb-0">Datos de envío y pago</h1>
    </div>

    @php
        // Datos de demostración
        $cartItems = [
            (object)['nombre' => 'Botella Andina 600ml', 'variante' => 'Verde Musgo · 600ml', 'grabado' => 'BRAYAN', 'precio' => 49.90, 'cantidad' => 2],
            (object)['nombre' => 'Bolsa Tote Orgánica', 'variante' => 'Natural · Grande', 'grabado' => null, 'precio' => 29.90, 'cantidad' => 1],
            (object)['nombre' => 'Set Cubiertos Bambú', 'variante' => 'Natural', 'grabado' => 'ECO', 'precio' => 34.90, 'cantidad' => 1],
        ];
        $subtotal = collect($cartItems)->sum(fn($i) => $i->precio * $i->cantidad);
        $envio = 9.90;
        $total = $subtotal + $envio;
    @endphp

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class="row g-4 g-lg-5">

            {{-- ===== Columna Izquierda: Formularios ===== --}}
            <div class="col-lg-7">

                {{-- Sección: Datos de contacto --}}
                <div class="card border mb-4" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light" style="width: 32px; height: 32px;">
                                <i class="bi bi-person-fill fs-7"></i>
                            </span>
                            <h2 class="font-mono fw-bold fs-6 text-uppercase mb-0">Datos de contacto</h2>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Nombre completo</label>
                                <input type="text" class="form-control py-2 rounded-2" id="nombre" name="nombre" placeholder="Tu nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Teléfono</label>
                                <input type="tel" class="form-control py-2 rounded-2" id="telefono" name="telefono" placeholder="999 999 999" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Email</label>
                                <input type="email" class="form-control py-2 rounded-2" id="email" name="email" placeholder="tu@correo.com" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sección: Dirección de envío --}}
                <div class="card border mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light" style="width: 32px; height: 32px;">
                                <i class="bi bi-geo-alt-fill fs-7"></i>
                            </span>
                            <h2 class="font-mono fw-bold fs-6 text-uppercase mb-0">Dirección de envío</h2>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="calle" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Calle / Avenida</label>
                                <input type="text" class="form-control py-2 rounded-2" id="calle" name="calle" placeholder="Av. Los Pinos" required>
                            </div>
                            <div class="col-md-4">
                                <label for="numero" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Número</label>
                                <input type="text" class="form-control py-2 rounded-2" id="numero" name="numero" placeholder="345" required>
                            </div>
                            <div class="col-12">
                                <label for="referencia" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Referencia</label>
                                <input type="text" class="form-control py-2 rounded-2" id="referencia" name="referencia" placeholder="Frente al parque, casa color crema">
                            </div>
                            <div class="col-md-4">
                                <label for="distrito" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Distrito</label>
                                <input type="text" class="form-control py-2 rounded-2" id="distrito" name="distrito" placeholder="Surco" required>
                            </div>
                            <div class="col-md-4">
                                <label for="provincia" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Provincia</label>
                                <input type="text" class="form-control py-2 rounded-2" id="provincia" name="provincia" placeholder="Lima" required>
                            </div>
                            <div class="col-md-4">
                                <label for="departamento" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Departamento</label>
                                <select class="form-select py-2 rounded-2" id="departamento" name="departamento" required>
                                    <option selected disabled>Seleccionar</option>
                                    <option>Lima</option>
                                    <option>Arequipa</option>
                                    <option>Cusco</option>
                                    <option>La Libertad</option>
                                    <option>Piura</option>
                                    <option>Lambayeque</option>
                                    <option>Junín</option>
                                    <option>Cajamarca</option>
                                    <option>Áncash</option>
                                    <option>Ica</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="codigo_postal" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Código Postal</label>
                                <input type="text" class="form-control py-2 rounded-2" id="codigo_postal" name="codigo_postal" placeholder="15023">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sección: Método de envío --}}
                <div class="card border mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light" style="width: 32px; height: 32px;">
                                <i class="bi bi-truck fs-7"></i>
                            </span>
                            <h2 class="font-mono fw-bold fs-6 text-uppercase mb-0">Método de envío</h2>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            {{-- Opción 1 --}}
                            <label class="d-flex align-items-center gap-3 p-3 border rounded-3 cursor-pointer" style="cursor: pointer;">
                                <input type="radio" class="form-check-input mt-0" name="envio" value="estandar" checked>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Envío estándar</span>
                                    <span class="font-mono fs-8 text-muted-eco">3-5 días hábiles · Lima Metropolitana</span>
                                </div>
                                <span class="font-mono fw-bold">S/ 9.90</span>
                            </label>
                            {{-- Opción 2 --}}
                            <label class="d-flex align-items-center gap-3 p-3 border rounded-3" style="cursor: pointer;">
                                <input type="radio" class="form-check-input mt-0" name="envio" value="express">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Envío express</span>
                                    <span class="font-mono fs-8 text-muted-eco">24-48 horas · Lima Metropolitana</span>
                                </div>
                                <span class="font-mono fw-bold">S/ 19.90</span>
                            </label>
                            {{-- Opción 3 --}}
                            <label class="d-flex align-items-center gap-3 p-3 border rounded-3" style="cursor: pointer;">
                                <input type="radio" class="form-check-input mt-0" name="envio" value="recojo">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Recojo en tienda</span>
                                    <span class="font-mono fs-8 text-muted-eco">Disponible en 24h · Surco, Lima</span>
                                </div>
                                <span class="font-mono fw-bold text-success">Gratis</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Sección: Método de pago --}}
                <div class="card border" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-light" style="width: 32px; height: 32px;">
                                <i class="bi bi-credit-card-fill fs-7"></i>
                            </span>
                            <h2 class="font-mono fw-bold fs-6 text-uppercase mb-0">Método de pago</h2>
                        </div>

                        {{-- Tabs de pago --}}
                        <ul class="nav nav-pills nav-justified mb-4 p-1 rounded-pill" style="background-color: #E8E2D4;" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-pill text-dark fw-semibold font-mono fs-7 py-2" id="card-tab" data-bs-toggle="tab" data-bs-target="#card-pane" type="button" role="tab">
                                    <i class="bi bi-credit-card me-1"></i> Tarjeta
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill text-dark fw-semibold font-mono fs-7 py-2" id="yape-tab" data-bs-toggle="tab" data-bs-target="#yape-pane" type="button" role="tab">
                                    Yape / Plin
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill text-dark fw-semibold font-mono fs-7 py-2" id="transfer-tab" data-bs-toggle="tab" data-bs-target="#transfer-pane" type="button" role="tab">
                                    Transferencia
                                </button>
                            </li>
                        </ul>

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
                                        <label for="card_number" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Número de tarjeta</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control py-2 rounded-2 pe-5" id="card_number" placeholder="4111 1111 1111 1111" maxlength="19">
                                            <i class="bi bi-credit-card-2-front position-absolute top-50 end-0 translate-middle-y me-3 text-muted-eco"></i>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="card_name" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Nombre en la tarjeta</label>
                                        <input type="text" class="form-control py-2 rounded-2" id="card_name" placeholder="BRAYAN DEVELOPER">
                                    </div>
                                    <div class="col-6">
                                        <label for="card_exp" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">Vencimiento</label>
                                        <input type="text" class="form-control py-2 rounded-2" id="card_exp" placeholder="MM/AA" maxlength="5">
                                    </div>
                                    <div class="col-6">
                                        <label for="card_cvv" class="form-label font-mono fs-8 text-uppercase fw-bold mb-1">CVV</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control py-2 rounded-2 pe-5" id="card_cvv" placeholder="•••" maxlength="4">
                                            <i class="bi bi-lock-fill position-absolute top-50 end-0 translate-middle-y me-3 text-muted-eco"></i>
                                        </div>
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
                                        Al confirmar, te enviaremos el número y código QR<br>para completar tu pago desde la app.
                                    </p>
                                </div>
                            </div>

                            {{-- Tab Transferencia --}}
                            <div class="tab-pane fade" id="transfer-pane" role="tabpanel">
                                <div class="bg-light rounded-3 p-4">
                                    <h5 class="font-serif mb-3">Datos de transferencia</h5>
                                    <div class="d-flex flex-column gap-2 font-mono fs-7">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted-eco">Banco</span>
                                            <span class="fw-bold">BCP</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted-eco">Cuenta corriente</span>
                                            <span class="fw-bold">191-XXXXXXX-0-XX</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted-eco">CCI</span>
                                            <span class="fw-bold">002-191-XXXXXXX-0-XX</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted-eco">Titular</span>
                                            <span class="fw-bold">ECOCREATIONS S.A.C.</span>
                                        </div>
                                    </div>
                                    <p class="text-muted-eco fs-8 mt-3 mb-0">
                                        <i class="bi bi-info-circle me-1"></i> Envía el comprobante a pagos@ecocreations.pe
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== Columna Derecha: Resumen del Pedido ===== --}}
            <div class="col-lg-5" data-aos="fade-left" data-aos-delay="100">
                <div class="card border sticky-lg-top" style="top: 6rem;">
                    <div class="card-body p-4">
                        <h2 class="font-mono fw-bold fs-6 text-uppercase mb-4">Resumen del pedido</h2>

                        {{-- Items mini --}}
                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach ($cartItems as $item)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center flex-shrink-0 position-relative"
                                         style="width: 56px; height: 56px;">
                                        <i class="bi bi-image text-primary opacity-50"></i>
                                        <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-dark font-mono" style="font-size: 0.6rem;">
                                            {{ $item->cantidad }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="fw-semibold mb-0 fs-7 text-truncate">{{ $item->nombre }}</p>
                                        <p class="text-muted-eco fs-8 mb-0">{{ $item->variante }}</p>
                                    </div>
                                    <span class="font-mono fw-bold fs-7 flex-shrink-0">
                                        S/ {{ number_format($item->precio * $item->cantidad, 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <hr class="opacity-25">

                        {{-- Totales --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted-eco">Subtotal</span>
                            <span class="font-mono fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted-eco">Envío</span>
                            <span class="font-mono fw-semibold">S/ {{ number_format($envio, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted-eco">Descuento</span>
                            <span class="font-mono fw-semibold text-success">- S/ 0.00</span>
                        </div>

                        <hr class="opacity-25">

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total a pagar</span>
                            <span class="font-mono fw-bold fs-4">S/ {{ number_format($total, 2) }}</span>
                        </div>

                        {{-- CTA --}}
                        <button type="submit"
                            class="btn btn-accent btn-lg w-100 rounded-pill font-mono fw-bold d-flex align-items-center justify-content-center gap-2 py-3 btn-animated">
                            <span class="btn-animated-label">
                                <i class="bi bi-lock-fill me-1"></i> Confirmar y pagar
                                <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                            </span>
                        </button>

                        <p class="text-center text-muted-eco font-mono fs-8 mt-3 mb-0">
                            <i class="bi bi-shield-lock-fill me-1"></i> Pago seguro procesado por Niubiz
                        </p>

                        {{-- Trust --}}
                        <div class="d-flex justify-content-center gap-4 mt-4 pt-3 border-top">
                            <div class="text-center">
                                <i class="bi bi-shield-check text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 text-muted-eco">SSL 256-bit</span>
                            </div>
                            <div class="text-center">
                                <i class="bi bi-arrow-repeat text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 text-muted-eco">Devolución 30d</span>
                            </div>
                            <div class="text-center">
                                <i class="bi bi-tree text-primary fs-5 d-block"></i>
                                <span class="font-mono fs-8 text-muted-eco">100% Eco</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
