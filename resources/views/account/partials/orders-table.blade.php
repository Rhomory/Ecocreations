{{--
    Tabla de pedidos reutilizable. Espera:
    - $orders: Collection|Paginator de Order con items.variant.product.images cargados
    - $compact (opcional): si true, oculta columna de productos en mobile y reduce padding
--}}
@php
    $compact = $compact ?? false;
@endphp

<div class="table-responsive orders-table">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th class="font-mono fs-8 text-uppercase fw-bold text-dark border-bottom border-2 py-3 ps-3" style="letter-spacing: 0.05em;">Pedido</th>
                <th class="font-mono fs-8 text-uppercase fw-bold text-dark border-bottom border-2 py-3 d-none d-md-table-cell" style="letter-spacing: 0.05em;">Fecha</th>
                <th class="font-mono fs-8 text-uppercase fw-bold text-dark border-bottom border-2 py-3 d-none d-lg-table-cell" style="letter-spacing: 0.05em;">Productos</th>
                <th class="font-mono fs-8 text-uppercase fw-bold text-dark border-bottom border-2 py-3 text-center" style="letter-spacing: 0.05em;">Estado</th>
                <th class="font-mono fs-8 text-uppercase fw-bold text-dark border-bottom border-2 py-3 text-end" style="letter-spacing: 0.05em;">Total</th>
                <th class="border-bottom border-2 py-3 pe-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                @php
                    $imgs = $order->items->take(3)->map(fn ($i) =>
                        $i->variant?->product?->images->sortByDesc('es_principal')->first()?->ruta
                    )->filter()->values();
                    $resumenProductos = $order->items->map(fn ($i) =>
                        ($i->variant?->product?->nombre ?? $i->nombre_producto).' ×'.$i->cantidad
                    )->implode(', ');

                    $estado = $order->estado;
                    $estadoLabel = match ($estado) {
                        'pendiente'  => 'Pendiente',
                        'pagado'     => 'Pagado',
                        'preparando' => 'Preparando',
                        'enviado'    => 'En camino',
                        'entregado'  => 'Entregado',
                        'cancelado'  => 'Cancelado',
                        default      => ucfirst($estado),
                    };
                    $estadoClase = match ($estado) {
                        'pendiente'  => 'badge-estado--pendiente',
                        'pagado',
                        'preparando' => 'badge-estado--pagado',
                        'enviado'    => 'badge-estado--enviado',
                        'entregado'  => 'badge-estado--entregado',
                        'cancelado'  => 'badge-estado--cancelado',
                        default      => 'badge-estado--pendiente',
                    };
                @endphp
                <tr>
                    <td class="ps-3 py-3 fw-bold font-mono fs-7">#{{ $order->numero_orden }}</td>
                    <td class="py-3 font-mono fs-8 text-muted-eco d-none d-md-table-cell">{{ $order->created_at->format('d.m.Y') }}</td>
                    <td class="py-3 fs-7 d-none d-lg-table-cell" style="max-width: 280px;">
                        <div class="d-flex align-items-center gap-2">
                            @foreach ($imgs as $url)
                                <x-cloud-img :src="$url" alt=""
                                    :w="80" :h="80" crop="fill"
                                    class="rounded flex-shrink-0 bg-secondary"
                                    style="width: 36px; height: 36px; object-fit: cover;" />
                            @endforeach
                            <span class="text-truncate flex-grow-1">{{ $resumenProductos }}</span>
                        </div>
                    </td>
                    <td class="py-3 text-center">
                        <span class="badge-estado {{ $estadoClase }} d-inline-flex align-items-center gap-1 rounded-pill font-mono fw-bold text-uppercase">
                            <span class="badge-estado__dot rounded-circle"></span>
                            {{ $estadoLabel }}
                        </span>
                    </td>
                    <td class="py-3 text-end fw-bold font-mono fs-7">S/ {{ number_format($order->total, 2) }}</td>
                    <td class="py-3 pe-3 text-end">
                        <a href="{{ route('account.order.detail', $order->id) }}"
                           class="text-accent text-decoration-none fw-bold d-inline-flex align-items-center gap-1 fs-7">
                            Ver <i class="bi bi-arrow-right"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if (! $compact && method_exists($orders, 'links'))
    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endif
