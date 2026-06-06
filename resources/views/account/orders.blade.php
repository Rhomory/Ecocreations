@extends('layouts.app')

@section('title', 'Mis pedidos — ECOCREATIONS')

@php
    // Reusamos las stats del hero (las calcula el controller para account.index;
    // acá las recalculamos por simplicidad del controller).
    $totalOrders = $user->orders()->count();
    $totalSpent = $user->orders()->where('estado', '!=', 'cancelado')->sum('total');
    $plasticAvoided = round($totalOrders * 0.45, 1);

    $filtros = [
        ['key' => 'todos',      'label' => 'Todos'],
        ['key' => 'pendiente',  'label' => 'Pendientes'],
        ['key' => 'pagado',     'label' => 'Pagados'],
        ['key' => 'enviado',    'label' => 'En camino'],
        ['key' => 'entregado',  'label' => 'Entregados'],
        ['key' => 'cancelado',  'label' => 'Cancelados'],
    ];
@endphp

@section('content')
    <div class="bg-light py-4 py-lg-5 account-section">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3" data-aos="fade-up">
                <ol class="breadcrumb fs-7 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted-eco">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('account.index') }}" class="text-decoration-none text-muted-eco">Mi cuenta</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mis pedidos</li>
                </ol>
            </nav>

            {{-- Hero --}}
            @include('account.partials.hero')

            {{-- Body --}}
            <div class="row g-4">

                {{-- Sidebar --}}
                <div class="col-12 col-md-3">
                    @include('account.partials.sidebar', ['activo' => 'pedidos'])
                </div>

                {{-- Content --}}
                <div class="col-12 col-md-9">
                    <div class="card border-0 shadow-sm rounded-3 bg-white" data-aos="fade-up">
                        <div class="card-body p-4 p-lg-5">

                            {{-- Header: título + filtros --}}
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3 mb-4">
                                <div>
                                    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-1" style="letter-spacing: 0.08em;">
                                        —— Historial completo
                                    </p>
                                    <h2 class="font-serif fs-3 mb-0">Mis pedidos</h2>
                                </div>

                                <div class="d-flex gap-2 flex-wrap" role="tablist">
                                    @foreach ($filtros as $f)
                                        @php
                                            $count = $conteoPorEstado[$f['key']] ?? 0;
                                            $esActivo = $estado === $f['key'];
                                        @endphp
                                        <a href="{{ route('account.orders', ['estado' => $f['key']]) }}"
                                           class="btn btn-sm rounded-pill px-3 py-1 font-mono fs-8 fw-semibold
                                                  {{ $esActivo ? 'btn-dark' : 'btn-outline-secondary border' }}">
                                            {{ $f['label'] }}
                                            <span class="ms-1 opacity-75">{{ $count }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Lista de pedidos --}}
                            @if ($orders->isEmpty())
                                <div class="text-center py-5 my-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3"
                                         style="width: 96px; height: 96px;">
                                        <i class="bi bi-bag fs-1 text-muted-eco opacity-50"></i>
                                    </div>
                                    @if ($estado === 'todos')
                                        <h3 class="font-serif fs-2 mb-2">Aún no tenés pedidos</h3>
                                        <p class="text-muted-eco mb-4">Cuando hagas tu primera compra, va a aparecer acá.</p>
                                        <a href="{{ route('catalog.index') }}"
                                           class="btn btn-accent rounded-pill px-4 py-3 fw-bold btn-animated">
                                            <span class="btn-animated-label">
                                                <i class="bi bi-shop me-2"></i> Ver catálogo
                                                <i class="bi bi-arrow-right ms-2 btn-animated-icon"></i>
                                            </span>
                                        </a>
                                    @else
                                        <h3 class="font-serif fs-3 mb-2">Sin resultados</h3>
                                        <p class="text-muted-eco mb-4">No tenés pedidos en estado "{{ $estado }}".</p>
                                        <a href="{{ route('account.orders') }}"
                                           class="btn btn-outline-dark rounded-pill px-4 py-2 fw-semibold">
                                            Ver todos
                                        </a>
                                    @endif
                                </div>
                            @else
                                @include('account.partials.orders-table', ['orders' => $orders, 'compact' => false])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
