{{--
    Sidebar de la sección "Mi cuenta".
    Espera la variable $activo (string): 'pedidos' | 'datos' | 'direcciones' | 'favoritos'.
--}}
@php
    $items = [
        ['key' => 'pedidos',     'icon' => 'bi-box-seam-fill', 'label' => 'Mis pedidos',  'href' => route('account.orders')],
        ['key' => 'datos',       'icon' => 'bi-person',        'label' => 'Mis datos',    'href' => route('account.index')],
        ['key' => 'direcciones', 'icon' => 'bi-geo-alt',       'label' => 'Direcciones',  'href' => route('account.addresses')],
        ['key' => 'favoritos',   'icon' => 'bi-heart',         'label' => 'Favoritos',    'href' => '#'],
    ];
@endphp

<nav class="account-sidebar d-flex flex-row flex-md-column gap-2 overflow-x-auto pb-3 pb-md-0">
    @foreach ($items as $item)
        @php $esActivo = ($activo ?? '') === $item['key']; @endphp
        <a href="{{ $item['href'] }}"
           class="account-sidebar__item d-flex align-items-center gap-2 text-decoration-none flex-shrink-0
                  {{ $esActivo ? 'account-sidebar__item--active' : '' }}">
            <i class="bi {{ $item['icon'] }}"></i>
            <span>{{ $item['label'] }}</span>
        </a>
    @endforeach

    <hr class="d-none d-md-block my-2 opacity-25">

    <form method="POST" action="{{ route('logout') }}" class="m-0 flex-shrink-0">
        @csrf
        <button type="submit"
                class="account-sidebar__item account-sidebar__item--danger d-flex align-items-center gap-2 border-0 bg-transparent w-100 text-start">
            <i class="bi bi-box-arrow-right"></i>
            <span>Cerrar sesión</span>
        </button>
    </form>
</nav>
