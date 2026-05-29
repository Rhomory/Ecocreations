@extends('layouts.app', ['hideNav' => true, 'hideFooter' => true])

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex">
    <aside class="bg-dark text-light d-flex flex-column p-4" style="width: 240px; min-height: 100vh;">

        {{-- Logo: redirige al inicio --}}
        <a href="{{ route('home') }}"
           class="text-light text-decoration-none font-serif fw-bold fs-5 d-flex align-items-center mb-4">
            <i class="bi bi-leaf-fill text-success me-2"></i>
            ECOCREATIONS
        </a>

        {{-- Navegación principal --}}
        <ul class="nav flex-column gap-2">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link text-light"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('admin.productos.index') }}" class="nav-link text-light"><i class="bi bi-box-seam me-2"></i>Productos</a></li>
            <li><a href="{{ route('admin.orders.index') }}" class="nav-link text-light"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a href="{{ route('admin.categorias.index') }}" class="nav-link text-light"><i class="bi bi-tags me-2"></i>Categorías</a></li>
            <li><a href="{{ route('admin.cupones.index') }}" class="nav-link text-light"><i class="bi bi-ticket-perforated me-2"></i>Cupones</a></li>
        </ul>

        {{-- Footer del sidebar: volver al sitio + logout --}}
        <div class="mt-auto pt-4 border-top border-secondary">
            <a href="{{ url('/') }}" class="nav-link text-muted">
                <i class="bi bi-arrow-left me-2"></i>Volver al sitio
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                @csrf
                <button type="submit" class="nav-link text-light bg-transparent border-0 w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-grow-1 p-4">
        <h1 class="font-serif">Dashboard</h1>
        <p class="text-muted-eco">KPIs, ventas, pedidos recientes.</p>
        <span class="badge bg-warning text-dark font-mono">PANTALLA EN CONSTRUCCIÓN</span>
    </div>
</div>
@endsection
