@extends('layouts.app')

@section('title', 'Mi cuenta — ECOCREATIONS')

@section('content')
    <div class="bg-light py-4 py-lg-5 account-section">
        <div class="container">

            {{-- Hero --}}
            @include('account.partials.hero')

            {{-- Body: sidebar + content --}}
            <div class="row g-4">

                {{-- Sidebar --}}
                <div class="col-12 col-md-3">
                    @include('account.partials.sidebar', ['activo' => 'datos'])
                </div>

                {{-- Content --}}
                <div class="col-12 col-md-9">
                    <div class="row g-4">

                        {{-- Pedidos recientes --}}
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3 bg-white" data-aos="fade-up">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-4">
                                        <div>
                                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1" style="letter-spacing: 0.08em;">
                                                —— Últimos movimientos
                                            </p>
                                            <h2 class="font-serif fs-3 mb-0">Pedidos recientes</h2>
                                        </div>
                                        @if ($orders->isNotEmpty())
                                            <a href="{{ route('account.orders') }}"
                                               class="text-dark text-decoration-none fw-semibold d-inline-flex align-items-center gap-1 fs-7">
                                                Ver todos <i class="bi bi-arrow-right"></i>
                                            </a>
                                        @endif
                                    </div>

                                    @if ($orders->isEmpty())
                                        <div class="text-center py-5">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3"
                                                 style="width: 80px; height: 80px;">
                                                <i class="bi bi-bag fs-2 text-muted-eco opacity-50"></i>
                                            </div>
                                            <h3 class="font-serif fs-4 mb-2">Aún no tenés pedidos</h3>
                                            <p class="text-muted-eco mb-4">Empezá a personalizar productos eco hoy.</p>
                                            <a href="{{ route('catalog.index') }}"
                                               class="btn btn-accent rounded-pill px-4 py-3 fw-bold btn-animated">
                                                <span class="btn-animated-label">
                                                    <i class="bi bi-shop me-2"></i> Ver catálogo
                                                    <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                                                </span>
                                            </a>
                                        </div>
                                    @else
                                        @include('account.partials.orders-table', ['orders' => $orders, 'compact' => true])
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Datos personales --}}
                        <div class="col-12 col-lg-6">
                            <div class="card border-0 shadow-sm rounded-3 bg-white h-100" data-aos="fade-up" data-aos-delay="100">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <div>
                                            <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1" style="letter-spacing: 0.08em;">
                                                —— Tu perfil
                                            </p>
                                            <h2 class="font-serif fs-4 mb-0">Datos personales</h2>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3" disabled>
                                            <i class="bi bi-pencil me-1"></i> Editar
                                        </button>
                                    </div>

                                    <dl class="row mb-0 fs-7">
                                        <dt class="col-5 font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-3">Nombre</dt>
                                        <dd class="col-7 fw-semibold mb-3">{{ $user->name }}</dd>

                                        <dt class="col-5 font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-3">Email</dt>
                                        <dd class="col-7 fw-semibold text-truncate mb-3">{{ $user->email }}</dd>

                                        @if ($user->clientProfile?->telefono)
                                            <dt class="col-5 font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-3">Teléfono</dt>
                                            <dd class="col-7 fw-semibold mb-3">{{ $user->clientProfile->telefono }}</dd>
                                        @endif

                                        @if ($user->clientProfile?->dni)
                                            <dt class="col-5 font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-3">DNI</dt>
                                            <dd class="col-7 fw-semibold mb-3">{{ $user->clientProfile->dni }}</dd>
                                        @endif

                                        <dt class="col-5 font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-0">Miembro desde</dt>
                                        <dd class="col-7 fw-semibold mb-0">{{ $user->created_at->translatedFormat('F Y') }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        {{-- Dirección principal --}}
                        <div class="col-12 col-lg-6">
                            @php $direccionPrincipal = $user->addresses->where('es_principal', true)->first() ?? $user->addresses->first(); @endphp
                            <div class="card border-0 shadow-sm rounded-3 bg-dark text-light h-100" data-aos="fade-up" data-aos-delay="200">
                                <div class="card-body p-4 p-lg-5 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <div>
                                            <p class="font-mono fs-8 text-uppercase mb-1 opacity-75" style="letter-spacing: 0.08em;">
                                                —— Envíos
                                            </p>
                                            <h2 class="font-serif fs-4 mb-0 text-light">Dirección principal</h2>
                                        </div>
                                        <i class="bi bi-geo-alt-fill text-accent fs-3"></i>
                                    </div>

                                    @if ($direccionPrincipal)
                                        <p class="fw-semibold mb-1">{{ $direccionPrincipal->alias }}</p>
                                        <p class="mb-1 opacity-75">
                                            {{ $direccionPrincipal->calle }} {{ $direccionPrincipal->numero }}
                                        </p>
                                        @if ($direccionPrincipal->referencia)
                                            <p class="mb-2 opacity-75 fs-7">{{ $direccionPrincipal->referencia }}</p>
                                        @endif
                                        <p class="font-mono fs-8 mb-0 opacity-75">
                                            {{ $direccionPrincipal->distrito }} · {{ $direccionPrincipal->departamento }}
                                            @if ($direccionPrincipal->codigo_postal)
                                                · {{ $direccionPrincipal->codigo_postal }}
                                            @endif
                                        </p>
                                    @else
                                        <p class="opacity-75 mb-3">Todavía no agregaste una dirección de envío.</p>
                                    @endif

                                    <a href="{{ route('account.addresses') }}"
                                       class="btn btn-accent rounded-pill px-4 py-2 fw-bold btn-animated mt-auto align-self-start">
                                        <span class="btn-animated-label">
                                            Gestionar direcciones <i class="bi bi-arrow-right ms-1 btn-animated-icon"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
