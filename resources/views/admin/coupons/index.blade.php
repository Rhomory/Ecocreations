@extends('layouts.app', ['hideNav' => true, 'hideFooter' => true])

@section('title', 'Cupones - Admin')

@section('content')
<div class="d-flex">
    <aside class="bg-dark text-light p-4" style="width: 240px; min-height: 100vh;">
        <h5 class="font-serif text-light mb-4">
            <i class="bi bi-leaf-fill text-success me-2"></i>Admin
        </h5>
        <ul class="nav flex-column gap-2">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link text-light"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('admin.productos.index') }}" class="nav-link text-light"><i class="bi bi-box-seam me-2"></i>Productos</a></li>
            <li><a href="{{ route('admin.orders.index') }}" class="nav-link text-light"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a href="{{ route('admin.categorias.index') }}" class="nav-link text-light"><i class="bi bi-tags me-2"></i>Categorías</a></li>
            <li><a href="{{ route('admin.cupones.index') }}" class="nav-link text-light"><i class="bi bi-ticket-perforated me-2"></i>Cupones</a></li>
            <li class="mt-4 pt-4 border-top border-secondary"><a href="{{ url('/') }}" class="nav-link text-muted"><i class="bi bi-arrow-left me-2"></i>Volver al sitio</a></li>
        </ul>
    </aside>
    <div class="flex-grow-1 p-4">
        <h1 class="font-serif">Cupones</h1>
        <p class="text-muted-eco">Lista de cupones con uso y vigencia.</p>
        <span class="badge bg-warning text-dark font-mono">PANTALLA EN CONSTRUCCIÓN</span>
    </div>
</div>
@endsection
