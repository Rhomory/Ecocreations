<nav class="navbar navbar-expand-lg bg-light border-bottom border-2 py-3 sticky-top navbar-animated">
    <div class="container">
        <a class="navbar-brand font-serif fw-bold fs-6 fs-sm-5 me-2" href="{{ route('home') }}">
            <i class="bi bi-leaf-fill text-primary me-1 me-sm-2"></i>ECOCREATIONS
        </a>

        {{-- Bloque derecho: íconos siempre visibles + hamburguesa en móvil --}}
        <div class="d-flex align-items-center flex-shrink-0 order-lg-3">
            <ul class="navbar-nav flex-row flex-nowrap align-items-center gap-lg-2">

                {{-- Búsqueda --}}
                <li class="nav-item">
                    <a class="nav-link px-1 px-lg-2" href="{{ route('catalog.index') }}" aria-label="Buscar">
                        <i class="bi bi-search fs-5"></i>
                    </a>
                </li>

                {{-- Usuario: dropdown según auth --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link px-1 px-lg-2 d-flex align-items-center" href="#" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-label="Mi cuenta">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="d-none d-lg-inline ms-2">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('account.index') }}">
                                    <i class="bi bi-person me-2"></i>Mi cuenta
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('account.orders') }}">
                                    <i class="bi bi-bag me-2"></i>Mis pedidos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('account.addresses') }}">
                                    <i class="bi bi-geo-alt me-2"></i>Mis direcciones
                                </a>
                            </li>

                            {{-- Solo admin ve esta opción --}}
                            @if (Auth::user()->role === 'admin')
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary fw-bold" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Panel admin
                                    </a>
                                </li>
                            @endif

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link px-1 px-lg-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#authModal" aria-label="Iniciar sesión">
                            <i class="bi bi-person fs-5"></i>
                        </a>
                    </li>
                @endauth

                {{-- Carrito --}}
                <li class="nav-item ms-1">
                    <a class="btn btn-dark rounded-pill text-light px-2 px-lg-3 py-2 d-flex align-items-center"
                        href="{{ route('cart.index') }}">
                        <i class="bi bi-bag"></i>
                        <span class="d-none d-lg-inline mx-1">Carrito</span>
                        <span class="text-light ms-1">0</span>
                    </a>
                </li>
            </ul>

            {{-- Hamburguesa: solo móvil --}}
            <button class="navbar-toggler border-0 ms-1 ms-sm-2 p-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        {{-- Menú principal: centrado en desktop, colapsable en móvil --}}
        <div class="collapse navbar-collapse justify-content-center order-lg-2" id="mainNav">
            <ul class="navbar-nav mx-auto align-items-lg-center gap-2">
                <li class="nav-item">
                    <a class="nav-link fw-light {{ request()->routeIs('catalog.*') ? 'active fw-semibold' : '' }}"
                        href="{{ route('catalog.index') }}">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-light {{ request()->routeIs('page.about') ? 'active fw-semibold' : '' }}"
                        href="{{ route('page.about') }}">Sobre nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-light {{ request()->routeIs('page.contact') ? 'active fw-semibold' : '' }}"
                        href="{{ route('page.contact') }}">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
