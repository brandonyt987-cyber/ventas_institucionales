@extends('layouts.vendedor')

@section('title', 'Mis Productos')

@section('content')
<div>
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Mis Productos</h2>
            <p class="text-gray-600">Gestiona tu catálogo de productos</p>
        </div>
        <a href="{{ route('vendedor.productos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
            + Nuevo Producto
        </a>
    </div>

    <!-- Alertas -->
    @if ($message = session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <!-- Búsqueda y Filtros -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <form action="{{ route('vendedor.productos.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input 
                type="text" 
                name="buscar" 
                placeholder="Buscar producto..." 
                value="{{ request('buscar') }}"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none"
            />

            <select name="orden" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none">
                <option value="created_at" {{ request('orden') === 'created_at' ? 'selected' : '' }}>Más recientes</option>
                <option value="nombre" {{ request('orden') === 'nombre' ? 'selected' : '' }}>Por nombre</option>
                <option value="precio" {{ request('orden') === 'precio' ? 'selected' : '' }}>Por precio</option>
                <option value="stock" {{ request('orden') === 'stock' ? 'selected' : '' }}>Por stock</option>
            </select>

            <select name="direccion" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none">
                <option value="desc" {{ request('direccion') === 'desc' ? 'selected' : '' }}>Descendente</option>
                <option value="asc" {{ request('direccion') === 'asc' ? 'selected' : '' }}>Ascendente</option>
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold">
                Filtrar
            </button>
        </form>
    </div>

    <!-- Tabla de Productos -->
    @if($productos->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Imagen</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Precio</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-12 w-12 object-cover rounded">
                                @else
                                    <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">Sin img</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">{{ $producto->nombre }}</p>
                                <p class="text-sm text-gray-600 line-clamp-1">{{ $producto->descripcion }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-blue-600">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $producto->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('vendedor.productos.edit', $producto->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-semibold">
                                        Editar
                                    </a>
                                    <form action="{{ route('vendedor.productos.destroy', $producto->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-semibold">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $productos->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay productos</h3>
            <p class="text-gray-500 mb-4">Comienza agregando tu primer producto</p>
            <a href="{{ route('vendedor.productos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold inline-block">
                Crear Producto
            </a>
        </div>
    @endif
</div>
@endsection