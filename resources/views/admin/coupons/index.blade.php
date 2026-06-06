@extends('layouts.admin')

@section('admin-title', 'Cupones')
@section('admin-page-title', 'Campañas de Descuento')

@section('admin-content')
<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="font-serif fw-bold text-dark m-0">Cupones</h5>
            <p class="text-muted-eco fs-8 m-0">Administra los cupones y ofertas de descuento</p>
        </div>
        <a href="{{ route('admin.cupones.create') }}" class="btn btn-success font-serif text-white py-2 px-3 rounded-2 shadow-sm fs-7">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Cupón
        </a>
    </div>

    <div class="text-center py-5 text-muted-eco">
        <i class="bi bi-ticket-perforated d-block display-4 mb-3 text-success"></i>
        <h4>Módulo de Cupones</h4>
        <p class="max-w-md mx-auto">Esta sección se encuentra actualmente en fase de integración. Aquí podrás crear códigos de descuento promocionales, configurar sus límites de uso y montos de rebaja.</p>
        <span class="badge bg-warning text-dark font-mono mt-2 px-3 py-2">PANTALLA EN CONSTRUCCIÓN</span>
    </div>
</div>
@endsection
