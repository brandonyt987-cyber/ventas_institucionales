@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
<div class="mb-10">
    <h2 class="text-4xl font-bold text-gray-800 mb-3">Gestión de Productos</h2>
    <p class="text-gray-600 text-lg">Todos los productos del sistema</p>
</div>

<!-- Tabla de productos -->
<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="px-10 py-7 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
        <h3 class="text-3xl font-bold flex items-center">
            <i class="fas fa-boxes mr-4 text-2xl"></i>
            Lista de Productos
        </h3>
    </div>

    @if($productos->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-4 border-indigo-600">
                    <tr>
                        <th class="px-10 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Imagen</th>
                        <th class="px-10 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Producto</th>
                        <th class="px-10 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Precio</th>
                        <th class="px-10 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Stock</th>
                        <th class="px-10 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-10 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($productos as $producto)
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 group">
                        <td class="px-10 py-8">
                            @if($producto->imagen)
                                <img 
                                    src="{{ asset('img/' . $producto->imagen) }}" 
                                    alt="{{ $producto->nombre }}" 
                                    class="w-16 h-16 object-cover rounded-2xl shadow-lg ring-4 ring-white"
                                    />

                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-2xl shadow-lg flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-10 py-8">
                            <p class="font-bold text-xl text-gray-900 group-hover:text-indigo-600 transition">
                                {{ $producto->nombre }}
                            </p>
                            <p class="text-gray-500 mt-1">{{ Str::limit($producto->descripcion, 70) }}</p>
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
                        <td class="px-10 py-8 text-center">
                            <div class="flex items-center justify-center space-x-4">
                                <a href="{{ route('admin.productos.edit', $producto) }}"
                                class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-2xl hover:from-blue-600 hover:to-blue-700 transition shadow-xl"
                                title="Editar producto">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>

                                <form action="{{ route('admin.productos.destroy', $producto) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="confirmarEliminacionSweet(event, '{{ $producto->nombre }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-gradient-to-r from-red-500 to-rose-600 text-white p-4 rounded-2xl hover:from-red-600 hover:to-rose-700 transition shadow-xl"
                                            title="Eliminar producto">
                                        <i class="fas fa-trash-alt text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-10 py-8 bg-gray-50 border-t-4 border-indigo-600">
            {{ $productos->links() }}
        </div>
    @else
        <div class="text-center py-24">
            <i class="fas fa-box-open text-9xl text-gray-200 mb-8"></i>
            <p class="text-gray-500 text-2xl font-medium">No hay productos registrados</p>
        </div>
    @endif
</div>
@endsection