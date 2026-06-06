@extends('layouts.admin')

@section('admin-title', 'Categorías')
@section('admin-page-title', 'Listado de Categorías')

@section('admin-content')
<div class="card border-0 shadow-sm rounded-3 p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="font-serif fw-bold text-dark m-0">Categorías</h5>
            <p class="text-muted-eco fs-8 m-0">Administra las categorías de productos</p>
        </div>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-success font-serif text-white py-2 px-3 rounded-2 shadow-sm fs-7">
            <i class="bi bi-plus-circle me-1"></i> Nueva Categoría
        </a>
    </div>

    <div class="text-center py-5 text-muted-eco">
        <i class="bi bi-tags d-block display-4 mb-3 text-success"></i>
        <h4>Módulo de Categorías</h4>
        <p class="max-w-md mx-auto">Esta sección se encuentra actualmente en fase de integración. Aquí podrás administrar las categorías del catálogo e-commerce para estructurar tus productos eco-amigables.</p>
        <span class="badge bg-warning text-dark font-mono mt-2 px-3 py-2">PANTALLA EN CONSTRUCCIÓN</span>
    </div>
</div>
@endsection
