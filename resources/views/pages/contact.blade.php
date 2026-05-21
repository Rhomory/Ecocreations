@extends('layouts.app')

@section('title', 'Contacto — ECOCREATIONS')

@section('content')
<div class="container py-4 py-lg-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-7">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Contacto</li>
        </ol>
    </nav>

    {{-- Header --}}
    <header class="mb-5" data-aos="fade-up">
        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">—— Escríbenos</p>
        <h1 class="font-serif display-4 mb-3">Conversemos sobre tu próximo regalo eco.</h1>
        <p class="text-muted-eco fs-5 mb-0" style="max-width: 56rem;">
            Responderemos tu mensaje en menos de 24 horas hábiles. También puedes
            escribirnos por WhatsApp o visitarnos en nuestro taller en Arequipa.
        </p>
    </header>

    <div class="row g-4">

        {{-- ===== Columna formulario ===== --}}
        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <div class="card border h-100">
                <div class="card-body p-4 p-lg-5">

                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">Formulario</p>
                    <h2 class="font-serif fs-3 mb-4">Cuéntanos qué necesitas</h2>

                    {{-- Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('page.contact.send') }}">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label font-mono fs-8 text-uppercase text-muted-eco">
                                    Nombre completo
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Tu nombre" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label font-mono fs-8 text-uppercase text-muted-eco">
                                    Correo
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="usuario@correo.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label font-mono fs-8 text-uppercase text-muted-eco">
                                Asunto
                            </label>
                            <select class="form-select @error('subject') is-invalid @enderror"
                                id="subject" name="subject" required>
                                <option value="" selected disabled>Selecciona un motivo</option>
                                <option value="corporativo">Consulta sobre regalo corporativo</option>
                                <option value="producto">Consulta sobre un producto</option>
                                <option value="pedido">Estado de mi pedido</option>
                                <option value="mayorista">Compra al por mayor</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label font-mono fs-8 text-uppercase text-muted-eco">
                                Mensaje
                            </label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                id="message" name="message" rows="5"
                                placeholder="Cuéntanos los detalles: cantidades, fechas, personalización…"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">
                            <p class="text-muted-eco fs-7 mb-0">
                                Al enviar aceptas nuestra política de privacidad.
                            </p>
                            <button type="submit" class="btn btn-accent rounded-pill px-4 btn-animated">
                                <span class="btn-animated-label">
                                    Enviar mensaje
                                    <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                                </span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- ===== Columna lateral ===== --}}
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-4">

                {{-- Card: canales directos --}}
                <div class="card border" data-aos="fade-left" data-aos-delay="150">
                    <div class="card-body p-4">
                        <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1">—— Canales directos</p>
                        <h3 class="font-serif fs-3 mb-4">Otras formas de hablarnos</h3>

                        {{-- Correo --}}
                        <div class="d-flex gap-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-envelope fs-5"></i>
                            </div>
                            <div>
                                <p class="font-mono fs-8 text-uppercase text-muted-eco mb-0">Correo</p>
                                <p class="fw-semibold mb-0">hola@ecocreations.pe</p>
                                <p class="text-muted-eco fs-7 mb-0">Te respondemos en menos de 24h hábiles</p>
                            </div>
                        </div>

                        <hr class="my-3 opacity-25">

                        {{-- Teléfono --}}
                        <div class="d-flex gap-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-telephone fs-5"></i>
                            </div>
                            <div>
                                <p class="font-mono fs-8 text-uppercase text-muted-eco mb-0">Teléfono</p>
                                <p class="fw-semibold mb-0">+51 987 654 321</p>
                                <p class="text-muted-eco fs-7 mb-0">Lun a Sáb · 9:00 — 18:00</p>
                            </div>
                        </div>

                        <hr class="my-3 opacity-25">

                        {{-- Taller --}}
                        <div class="d-flex gap-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-geo-alt fs-5"></i>
                            </div>
                            <div>
                                <p class="font-mono fs-8 text-uppercase text-muted-eco mb-0">Taller</p>
                                <p class="fw-semibold mb-0">Av. Sostenibilidad 245</p>
                                <p class="text-muted-eco fs-7 mb-0">Arequipa · Perú</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card: WhatsApp --}}
                <div class="card bg-primary border-0" data-aos="fade-left" data-aos-delay="250">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-whatsapp text-primary fs-5"></i>
                            </div>
                            <p class="font-mono fs-8 text-uppercase mb-0 text-secondary">WhatsApp</p>
                        </div>
                        <h3 class="font-serif fs-3 text-light mb-2">¿Prefieres respuesta inmediata?</h3>
                        <p class="text-secondary mb-4">
                            Escríbenos por WhatsApp y un asesor te atenderá en horario de oficina.
                        </p>
                        <a href="https://wa.me/51987654321" target="_blank" rel="noopener"
                            class="btn btn-accent rounded-pill w-100 btn-animated">
                            <span class="btn-animated-label">
                                Abrir conversación
                                <i class="bi bi-box-arrow-up-right ms-1 btn-animated-icon"></i>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Card: FAQ --}}
                <a href="#" class="card bg-light border text-decoration-none faq-card"
                    data-aos="fade-left" data-aos-delay="350">
                    <div class="card-body p-3 px-4 d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <p class="fw-semibold mb-0 text-body">¿Tienes una duda rápida?</p>
                            <p class="text-muted-eco fs-7 mb-0">Revisa las preguntas frecuentes</p>
                        </div>
                        <i class="bi bi-arrow-up-right fs-5 text-body faq-card-arrow"></i>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>
@endsection
