@extends('layouts.admin')

@section('admin-title', 'Pedidos')
@section('admin-page-title', 'Listado de Pedidos')

@section('admin-content')
<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="font-serif fw-bold text-dark m-0">Pedidos</h5>
            <p class="text-muted-eco fs-8 m-0">Monitorea y despacha las órdenes de tus clientes</p>
        </div>
    </div>

    <div class="text-center py-5 text-muted-eco">
        <i class="bi bi-bag d-block display-4 mb-3 text-success"></i>
        <h4>Módulo de Pedidos</h4>
        <p class="max-w-md mx-auto">Esta sección se encuentra actualmente en fase de integración. Aquí podrás visualizar el listado completo de pedidos, cambiar sus estados (preparando, enviado, entregado) y verificar detalles de pago.</p>
        <span class="badge bg-warning text-dark font-mono mt-2 px-3 py-2">PANTALLA EN CONSTRUCCIÓN</span>
    </div>
</div>
@endsection
