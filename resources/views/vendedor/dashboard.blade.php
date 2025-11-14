@extends('layouts.vendedor')

@section('title', 'Dashboard Vendedor')

@section('content')
<div>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard de Vendedor</h2>
        <p class="text-gray-600">Gestiona tus productos y clientes desde tu panel principal.</p>
    </div>

    <!-- GRID DE TARJETAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Tarjeta: Mis Clientes -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="text-5xl mb-4">👥</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Mis Clientes</h3>
            <p class="text-gray-600 text-sm mb-6">Ver tus clientes registrados</p>
            <a href="{{ route('vendedor.clientes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                Ver Clientes
            </a>
        </div>

        <!-- Tarjeta: Ver Productos -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="text-5xl mb-4">📦</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Ver Productos</h3>
            <p class="text-gray-600 text-sm mb-6">Consulta y administra tus productos</p>
            <a href="{{ route('vendedor.productos.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                Ver Productos
            </a>
        </div>

        <!-- Tarjeta: Nuevo Producto -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
            <div class="text-5xl mb-4">🛒</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Nuevo Producto</h3>
            <p class="text-gray-600 text-sm mb-6">Agrega un nuevo producto al catálogo</p>
            <a href="{{ route('vendedor.productos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                Agregar Producto
            </a>
        </div>

    </div>
</div>
@endsection