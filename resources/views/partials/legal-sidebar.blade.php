{{--
    Sidebar de navegación para las páginas legales.
    Marca como activa la que coincide con la ruta actual.
--}}
@php
    $legalLinks = [
        ['route' => 'page.terms',    'icon' => 'bi-file-text',     'label' => 'Términos y condiciones'],
        ['route' => 'page.privacy',  'icon' => 'bi-shield-lock',   'label' => 'Política de privacidad'],
        ['route' => 'page.shipping', 'icon' => 'bi-truck',         'label' => 'Envíos y entregas'],
        ['route' => 'page.returns',  'icon' => 'bi-arrow-repeat',  'label' => 'Cambios y devoluciones'],
    ];
@endphp

<div class="sticky-lg-top" style="top: 6rem;">
    <p class="font-mono fs-8 text-muted-eco text-uppercase mb-2">Documentos</p>

    <ul class="nav flex-column gap-1 mb-4">
        @foreach ($legalLinks as $link)
            @php $isActive = request()->routeIs($link['route']); @endphp
            <li class="nav-item">
                <a href="{{ route($link['route']) }}"
                    class="nav-link rounded d-flex align-items-center gap-2 {{ $isActive ? 'bg-primary text-light' : 'text-body legal-nav-link' }}">
                    <i class="bi {{ $link['icon'] }}"></i>
                    <span class="fs-7">{{ $link['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Card de ayuda --}}
    <div class="card border">
        <div class="card-body p-3">
            <p class="fw-semibold mb-1">¿Tienes dudas?</p>
            <p class="text-muted-eco fs-7 mb-2">
                Escríbenos y te ayudamos a resolverlas.
            </p>
            <a href="{{ route('page.contact') }}" class="text-accent fw-semibold fs-7 text-decoration-none">
                Ir a Contacto <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
