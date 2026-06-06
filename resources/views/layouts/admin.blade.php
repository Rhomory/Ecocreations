@extends('layouts.app', ['hideNav' => true, 'hideFooter' => true])

@section('title')
    @yield('admin-title', 'Panel de Administración') - ECOCREATIONS
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        
        {{-- Sidebar: Offcanvas on mobile, static on desktop --}}
        <aside class="col-md-3 col-lg-2 offcanvas-md offcanvas-start bg-dark text-light border-end border-secondary border-opacity-25" 
               tabindex="-1" 
               id="adminSidebar" 
               aria-labelledby="adminSidebarLabel"
               style="z-index: 1045;">
            
            <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
                <h5 class="offcanvas-title font-serif text-light" id="adminSidebarLabel">
                    <i class="bi bi-leaf-fill text-success me-2"></i>ECOCREATIONS
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebar" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column p-4 pt-md-4 h-100">
                {{-- Brand Logo (desktop) --}}
                <div class="d-none d-md-flex align-items-center mb-4 pb-2 border-bottom border-secondary border-opacity-25 w-100">
                    <a href="{{ route('home') }}" class="text-light text-decoration-none font-serif fw-bold fs-5 d-flex align-items-center">
                        <i class="bi bi-leaf-fill text-success me-2"></i>
                        ECOCREATIONS
                    </a>
                </div>

                {{-- Nav menu --}}
                <ul class="nav flex-column gap-2 mb-auto w-100">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link px-3 py-2 rounded-2 d-flex align-items-center gap-3 transition-all {{ Route::is('admin.dashboard') ? 'bg-success text-white fw-medium' : 'text-light text-opacity-75 hover-bg-light-opacity' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.productos.index') }}" 
                           class="nav-link px-3 py-2 rounded-2 d-flex align-items-center gap-3 transition-all {{ Route::is('admin.productos.*') ? 'bg-success text-white fw-medium' : 'text-light text-opacity-75 hover-bg-light-opacity' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" 
                           class="nav-link px-3 py-2 rounded-2 d-flex align-items-center gap-3 transition-all {{ Route::is('admin.orders.*') ? 'bg-success text-white fw-medium' : 'text-light text-opacity-75 hover-bg-light-opacity' }}">
                            <i class="bi bi-bag"></i>
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categorias.index') }}" 
                           class="nav-link px-3 py-2 rounded-2 d-flex align-items-center gap-3 transition-all {{ Route::is('admin.categorias.*') ? 'bg-success text-white fw-medium' : 'text-light text-opacity-75 hover-bg-light-opacity' }}">
                            <i class="bi bi-tags"></i>
                            <span>Categorías</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cupones.index') }}" 
                           class="nav-link px-3 py-2 rounded-2 d-flex align-items-center gap-3 transition-all {{ Route::is('admin.cupones.*') ? 'bg-success text-white fw-medium' : 'text-light text-opacity-75 hover-bg-light-opacity' }}">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Cupones</span>
                        </a>
                    </li>
                </ul>

                {{-- Sidebar footer actions --}}
                <div class="mt-auto pt-4 border-top border-secondary border-opacity-25 w-100">
                    <a href="{{ url('/') }}" class="nav-link px-3 py-2 text-muted rounded-2 d-flex align-items-center gap-3 hover-bg-light-opacity">
                        <i class="bi bi-arrow-left"></i>
                        <span>Ir a la tienda</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0 mt-1">
                        @csrf
                        <button type="submit" class="nav-link px-3 py-2 text-light text-opacity-75 rounded-2 d-flex align-items-center gap-3 bg-transparent border-0 w-100 text-start hover-bg-light-opacity">
                            <i class="bi bi-box-arrow-right text-danger"></i>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Area --}}
        <div class="col-md-9 col-lg-10 d-flex flex-column min-vh-100 bg-light">
            {{-- Top Navbar for admin controls & user profile info --}}
            <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3 py-2 sticky-top shadow-sm">
                <div class="container-fluid p-0">
                    
                    {{-- Toggle Button for mobile sidebar & Logo on Mobile --}}
                    <div class="d-flex align-items-center">
                        <button class="btn border-0 p-2 text-dark bg-light rounded-circle d-md-none me-2 d-flex align-items-center justify-content-center" 
                                type="button" 
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#adminSidebar" 
                                aria-controls="adminSidebar"
                                style="width: 40px; height: 40px;">
                            <i class="bi bi-list fs-4"></i>
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none font-serif fw-bold text-dark d-md-none fs-6 d-flex align-items-center">
                            <i class="bi bi-leaf-fill text-success me-1"></i>ECO
                        </a>
                    </div>

                    {{-- Page context title (desktop only) --}}
                    <div class="d-none d-sm-block">
                        <span class="text-muted fs-8 font-mono text-uppercase">Panel Admin</span>
                        <h6 class="m-0 font-serif text-dark fw-bold">@yield('admin-page-title', 'Inicio')</h6>
                    </div>

                    {{-- Right-side User info & actions --}}
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="text-end d-none d-sm-block">
                            <div class="fw-bold fs-7 text-dark">{{ Auth::user()->name ?? 'Administrador' }}</div>
                            <div class="text-muted-eco fs-8 font-mono">{{ Auth::user()->email ?? 'admin@ecocreations.pe' }}</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link p-0 text-decoration-none" type="button" id="adminUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold font-serif" style="width: 40px; height: 40px;">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="adminUserDropdown">
                                <li><a class="dropdown-item py-2" href="{{ url('/') }}"><i class="bi bi-shop me-2 text-success"></i>Ver Tienda</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content Area --}}
            <main class="flex-grow-1 p-3 p-md-4">
                @yield('admin-content')
            </main>
        </div>
    </div>
</div>

<style>
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    .hover-bg-light-opacity:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff !important;
    }
</style>
@endsection
