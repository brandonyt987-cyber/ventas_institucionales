@extends('layouts.admin')

@section('title', 'Inventario')

@section('content')
<div class="mb-10">
    <h2 class="text-4xl font-bold text-gray-800 mb-3">Inventario General</h2>
    <p class="text-gray-600 text-lg">Control total de productos y existencias</p>
</div>

<!-- 3 Tarjetas GRANDES y PODEROSAS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
    
    <!-- Total Productos -->
    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-3xl shadow-2xl p-10 transform hover:scale-105 transition-all duration-300 border-t-8 border-indigo-400">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-indigo-100 text-lg font-medium opacity-90">Total Productos</p>
                <h3 class="text-6xl font-bold mt-4">{{ $totalProductos }}</h3>
            </div>
            <i class="fas fa-cubes text-8xl opacity-20"></i>
        </div>
    </div>

    <!-- Stock Total -->
    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-3xl shadow-2xl p-10 transform hover:scale-105 transition-all duration-300 border-t-8 border-emerald-400">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-100 text-lg font-medium opacity-90">Stock Total</p>
                <h3 class="text-6xl font-bold mt-4">{{ $stockTotal }}</h3>
                <p class="text-sm mt-2 opacity-80">unidades disponibles</p>
            </div>
            <i class="fas fa-warehouse text-8xl opacity-20"></i>
        </div>
    </div>

    <!-- Productos Sin Stock -->
    <div class="bg-gradient-to-br from-rose-500 to-red-600 text-white rounded-3xl shadow-2xl p-10 transform hover:scale-105 transition-all duration-300 border-t-8 border-rose-400 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-rose-100 text-lg font-medium opacity-90">Sin Stock</p>
                <h3 class="text-6xl font-bold mt-4">{{ $sinStock }}</h3>
                <p class="text-sm mt-2 opacity-80">requieren atención inmediata</p>
            </div>
            <i class="fas fa-exclamation-circle text-8xl opacity-20"></i>
        </div>
        @if($sinStock > 0)
            <div class="absolute top-4 right-4 animate-ping">
                <div class="h-8 w-8 bg-red-400 rounded-full opacity-75"></div>
            </div>
            <div class="absolute top-4 right-4">
                <div class="h-8 w-8 bg-red-600 rounded-full"></div>
            </div>
        @endif
    </div>
</div>

<!-- Tabla de productos (ULTRA MEJORADA) -->
<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="px-10 py-7 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
        <h3 class="text-3xl font-bold flex items-center">
            <i class="fas fa-th-list mr-4 text-2xl"></i>
            Todos los Productos
        </h3>
    </div>

    @if($productos->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-4 border-indigo-600">
                    <tr>
                        <th class="px-10 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Producto</th>
                        <th class="px-10 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Precio</th>
                        <th class="px-10 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Stock Actual</th>
                        <th class="px-10 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($productos as $producto)
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 group">
                        <td class="px-10 py-8">
                            <div class="flex items-center">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                         class="w-16 h-16 object-cover rounded-2xl shadow-lg mr-6 ring-4 ring-white">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-2xl shadow-lg mr-6 flex items-center justify-center ring-4 ring-white">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-xl text-gray-900 group-hover:text-indigo-600 transition">
                                        {{ $producto->nombre }}
                                    </p>
                                    <p class="text-gray-500 mt-1">{{ Str::limit($producto->descripcion, 70) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <span class="text-2xl font-bold text-gray-800">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="text-3xl font-bold 
                                {{ $producto->stock == 0 ? 'text-red-600' : ($producto->stock <= 10 ? 'text-orange-600' : 'text-emerald-600') }}">
                                {{ $producto->stock }}
                            </span>
                        </td>
                        <td class="px-10 py-8 text-center">
                            @if($producto->stock == 0)
                                <span class="px-6 py-3 rounded-full text-lg font-bold bg-red-100 text-red-800 shadow-lg">
                                    <i class="fas fa-times-circle mr-2"></i> AGOTADO
                                </span>
                            @elseif($producto->stock <= 10)
                                <span class="px-6 py-3 rounded-full text-lg font-bold bg-orange-100 text-orange-800 shadow-lg animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> BAJO
                                </span>
                            @else
                                <span class="px-6 py-3 rounded-full text-lg font-bold bg-emerald-100 text-emerald-800 shadow-lg">
                                    <i class="fas fa-check-circle mr-2"></i> DISPONIBLE
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-10 py-8 bg-gray-50 border-t-4 border-indigo-600">
            {{ $productos->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection