@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Gestión de Inventario</h2>
        <p class="text-gray-600">Control de productos y stock en el sistema</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Productos -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Productos</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalProductos }}</p>
                </div>
                <div class="text-4xl text-blue-200">📦</div>
            </div>
        </div>

        <!-- Stock Total -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Stock Total</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stockTotal }}</p>
                </div>
                <div class="text-4xl text-green-200">✅</div>
            </div>
        </div>

        <!-- Stock Bajo -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Stock Bajo</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stockBajo }}</p>
                </div>
                <div class="text-4xl text-yellow-200">⚠️</div>
            </div>
        </div>

        <!-- Sin Stock -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Sin Stock</p>
                    <p class="text-3xl font-bold text-red-600">{{ $sinStock }}</p>
                </div>
                <div class="text-4xl text-red-200">❌</div>
            </div>
        </div>
    </div>

    <!-- Tabla de Productos -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Todos los Productos</h3>
        </div>

        @if($productos->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Producto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Vendedor</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Precio</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $producto->nombre }}</p>
                                    <p class="text-sm text-gray-600">{{ Str::limit($producto->descripcion, 50) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $producto->vendedor->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-blue-600">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                {{ $producto->stock }}
                            </td>
                            <td class="px-6 py-4">
                                @if($producto->stock > 10)
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                        Disponible
                                    </span>
                                @elseif($producto->stock > 0)
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                        Bajo
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                        Agotado
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $productos->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-gray-500">No hay productos en el sistema</p>
            </div>
        @endif
    </div>
</div>
@endsection