@extends('layouts.admin')

@section('admin-title', 'Dashboard')
@section('admin-page-title', 'Resumen de Negocio')

@section('admin-content')
@php
    $maxAmount = max(array_column($salesData, 'amount')) ?: 1000;
@endphp

<div class="container-fluid p-0">
    {{-- KPI Cards Row --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Ventas --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 p-md-4 d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-currency-dollar fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted fs-8 font-mono text-uppercase">Ventas Totales</span>
                        <h3 class="fw-bold font-mono text-dark m-0 mt-1">S/ {{ number_format($totalSales, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Pedidos --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 p-md-4 d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-cart3 fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted fs-8 font-mono text-uppercase">Total Pedidos</span>
                        <h3 class="fw-bold font-mono text-dark m-0 mt-1">{{ $ordersCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Clientes --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 p-md-4 d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted fs-8 font-mono text-uppercase">Clientes</span>
                        <h3 class="fw-bold font-mono text-dark m-0 mt-1">{{ $clientsCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Productos --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body p-3 p-md-4 d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted fs-8 font-mono text-uppercase">Catálogo</span>
                        <h3 class="fw-bold font-mono text-dark m-0 mt-1">{{ $productsCount }} <span class="fs-8 text-muted fw-normal">prod.</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Section: Chart + Details Table --}}
    <div class="row g-4">
        {{-- Chart and Recent Orders (col-12 col-xl-8) --}}
        <div class="col-12 col-xl-8">
            {{-- Weekly Sales Chart --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="font-serif fw-bold text-dark m-0">Ventas Recientes</h5>
                        <p class="text-muted-eco fs-8 m-0">Últimos 7 días de facturación activa</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fs-8 font-mono">S/ Semanal</span>
                </div>
                <div class="card-body p-4">
                    {{-- Responsive SVG Chart --}}
                    <div class="chart-container position-relative" style="width: 100%; height: 260px;">
                        <svg viewBox="0 0 600 240" width="100%" height="100%" preserveAspectRatio="none" class="pe-none">
                            <defs>
                                <linearGradient id="barGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#3D4F2E" />
                                    <stop offset="100%" stop-color="#A8B89A" stop-opacity="0.4" />
                                </linearGradient>
                            </defs>
                            
                            {{-- Grid Lines --}}
                            <line x1="40" y1="40" x2="580" y2="40" stroke="#f0f0f0" stroke-width="1" />
                            <line x1="40" y1="90" x2="580" y2="90" stroke="#f0f0f0" stroke-width="1" />
                            <line x1="40" y1="140" x2="580" y2="140" stroke="#f0f0f0" stroke-width="1" />
                            <line x1="40" y1="190" x2="580" y2="190" stroke="#ddd" stroke-width="1.5" />
                            
                            {{-- Left Axis Y Labels --}}
                            <text x="30" y="45" font-family="JetBrains Mono, monospace" font-size="9" fill="#888" text-anchor="end">S/ {{ number_format($maxAmount, 0) }}</text>
                            <text x="30" y="115" font-family="JetBrains Mono, monospace" font-size="9" fill="#888" text-anchor="end">S/ {{ number_format($maxAmount / 2, 0) }}</text>
                            <text x="30" y="195" font-family="JetBrains Mono, monospace" font-size="9" fill="#888" text-anchor="end">0</text>

                            {{-- Bars and Labels --}}
                            @foreach($salesData as $index => $sale)
                                @php
                                    $colWidth = 540 / 7;
                                    $x = 40 + ($index * $colWidth) + ($colWidth - 45) / 2;
                                    $barHeight = $maxAmount > 0 ? ($sale['amount'] / $maxAmount) * 150 : 0;
                                    $y = 190 - $barHeight;
                                @endphp
                                
                                {{-- The Bar --}}
                                <rect x="{{ $x }}" y="{{ $y }}" width="45" height="{{ max($barHeight, 2) }}" rx="4" fill="url(#barGradient)" class="pe-auto transition-all" />
                                
                                {{-- Hover Value Text (shows amount) --}}
                                @if($sale['amount'] > 0)
                                    <text x="{{ $x + 22.5 }}" y="{{ $y - 8 }}" font-family="JetBrains Mono, monospace" font-size="10" font-weight="bold" fill="#3D4F2E" text-anchor="middle">S/{{ number_format($sale['amount'], 0, '.', '') }}</text>
                                @endif

                                {{-- X Label --}}
                                <text x="{{ $x + 22.5 }}" y="212" font-family="Inter Tight, sans-serif" font-size="10" font-weight="500" fill="#555" text-anchor="middle">{{ $sale['day'] }}</text>
                                <text x="{{ $x + 22.5 }}" y="226" font-family="JetBrains Mono, monospace" font-size="8" fill="#aaa" text-anchor="middle">{{ date('d/m', strtotime($sale['date'])) }}</text>
                            @endforeach
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Recent Orders Table --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="font-serif fw-bold text-dark m-0">Pedidos Recientes</h5>
                        <p class="text-muted-eco fs-8 m-0">Últimos movimientos registrados en tienda</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success font-serif py-1 px-3 fs-8 rounded-pill">Ver Todos</a>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover m-0">
                            <thead>
                                <tr class="text-muted fs-8 font-mono text-uppercase">
                                    <th class="border-0 ps-0">Orden</th>
                                    <th class="border-0">Cliente</th>
                                    <th class="border-0">Fecha</th>
                                    <th class="border-0 text-end">Total</th>
                                    <th class="border-0 text-center">Estado</th>
                                    <th class="border-0 text-end pe-0">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td class="ps-0 fw-bold font-mono fs-7 text-dark">{{ $order->numero_orden }}</td>
                                        <td>
                                            <div class="fw-medium text-dark">{{ $order->user->name }}</div>
                                            <div class="text-muted fs-8 font-mono">{{ $order->user->email }}</div>
                                        </td>
                                        <td class="fs-8 font-mono text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-end fw-bold font-mono fs-7 text-dark">S/ {{ number_format($order->total, 2) }}</td>
                                        <td class="text-center">
                                            @php
                                                $badgeClass = match($order->estado) {
                                                    'pendiente' => 'bg-warning text-dark',
                                                    'pagado', 'preparando' => 'bg-info text-white',
                                                    'enviado' => 'bg-primary text-white',
                                                    'entregado' => 'bg-success text-white',
                                                    'cancelado' => 'bg-danger text-white',
                                                    default => 'bg-secondary text-white'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1 fs-8 text-capitalize font-sans">{{ $order->estado }}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border btn-animated fs-8 px-2 py-1">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted-eco">
                                            <i class="bi bi-info-circle d-block fs-3 mb-2"></i>
                                            No hay pedidos registrados en el sistema.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alerts and Inventory (col-12 col-xl-4) --}}
        <div class="col-12 col-xl-4">
            {{-- Inventory Warnings --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="font-serif fw-bold text-dark m-0">Alertas de Stock</h5>
                    <p class="text-muted-eco fs-8 m-0">Variantes con stock menor a 5 unidades</p>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        @forelse($lowStockProducts as $variant)
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-2 border bg-light bg-opacity-50">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-success bg-opacity-10 p-2 text-success rounded-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                    </div>
                                    <div style="max-width: 170px;">
                                        <div class="fw-bold fs-7 text-dark text-truncate">{{ $variant->product->nombre }}</div>
                                        <div class="text-muted fs-8 font-mono text-truncate">
                                            SKU: {{ $variant->sku }} 
                                            @if($variant->color) | {{ $variant->color }} @endif
                                            @if($variant->tamano) | {{ $variant->tamano }} @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-danger rounded-pill font-mono px-2 py-1 fs-8">Stock: {{ $variant->stock }}</span>
                                    <a href="{{ route('admin.productos.edit', $variant->product->id) }}" class="d-block fs-8 text-success fw-medium text-decoration-none mt-1">Surtir <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted-eco bg-light rounded-3 border border-dashed">
                                <i class="bi bi-check-circle-fill text-success fs-3 mb-2 d-block"></i>
                                Todo el inventario se encuentra al día.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Quick Stats / Status Indicators --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="font-serif fw-bold text-dark m-0">Enlaces Rápidos</h5>
                    <p class="text-muted-eco fs-8 m-0">Accesos directos a la administración</p>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-success font-serif text-white py-2 w-100 text-start d-flex align-items-center justify-content-between rounded-2 shadow-sm">
                            <span><i class="bi bi-plus-circle me-2"></i> Nuevo Producto</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-dark py-2 w-100 text-start d-flex align-items-center justify-content-between rounded-2">
                            <span><i class="bi bi-tags me-2 text-success"></i> Gestionar Categorías</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="{{ route('admin.cupones.index') }}" class="btn btn-outline-dark py-2 w-100 text-start d-flex align-items-center justify-content-between rounded-2">
                            <span><i class="bi bi-ticket-perforated me-2 text-success"></i> Campañas de Cupones</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
