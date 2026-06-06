{{--
    Hero compartido de "Mi cuenta" + "Mis pedidos".
    Espera: $user, $totalOrders, $totalSpent, $plasticAvoided.
--}}
<div class="row align-items-center g-4 mb-4 mb-lg-5">
    <div class="col-12 col-lg-6">
        <p class="font-mono fs-8 text-muted-eco text-uppercase fw-semibold mb-2" style="letter-spacing: 0.08em;">
            —— Tu cuenta · Miembro desde {{ $user->created_at->format('Y') }}
        </p>
        <h1 class="font-serif display-3 fw-normal lh-1 mb-0">
            Hola, {{ explode(' ', $user->name)[0] }}.
        </h1>
    </div>

    <div class="col-12 col-lg-6">
        <div class="row g-2 g-md-3 account-stats">
            <div class="col-4">
                <div class="account-stat bg-white border rounded-3 p-3 p-md-4 h-100">
                    <p class="font-serif fs-2 fw-medium mb-1 lh-1">{{ $totalOrders }}</p>
                    <p class="font-mono text-muted-eco text-uppercase mb-0" style="font-size: 0.625rem; letter-spacing: 0.08em;">
                        Pedidos<br class="d-none d-md-inline"> realizados
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="account-stat bg-primary text-light rounded-3 p-3 p-md-4 h-100">
                    <p class="font-serif fs-2 fw-medium mb-1 lh-1">
                        @if ($totalSpent >= 1000)
                            S/ {{ number_format($totalSpent / 1000, 1) }}K
                        @else
                            S/ {{ number_format($totalSpent, 0) }}
                        @endif
                    </p>
                    <p class="font-mono text-uppercase mb-0 opacity-75" style="font-size: 0.625rem; letter-spacing: 0.08em;">
                        Total<br class="d-none d-md-inline"> invertido
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="account-stat bg-accent text-light rounded-3 p-3 p-md-4 h-100">
                    <p class="font-serif fs-2 fw-medium mb-1 lh-1">{{ number_format($plasticAvoided, 1) }} kg</p>
                    <p class="font-mono text-uppercase mb-0 opacity-75" style="font-size: 0.625rem; letter-spacing: 0.08em;">
                        Plástico<br class="d-none d-md-inline"> evitado
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
