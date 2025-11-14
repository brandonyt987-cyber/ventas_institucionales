@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Lista de Productos</h2>
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left border-b">Nombre</th>
                <th class="px-4 py-2 text-left border-b">Descripción</th>
                <th class="px-4 py-2 text-left border-b">Precio</th>
                <th class="px-4 py-2 text-left border-b">Stock</th>
                <th class="px-4 py-2 text-left border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">{{ $producto->nombre }}</td>
                <td class="py-3 px-4">{{ $producto->descripcion }}</td>
                <td class="py-3 px-4">{{ $producto->precio }}</td>
                <td class="py-3 px-4">{{ $producto->stock }}</td>
                <td class="py-3 px-4">
                    <a href="{{ route('admin.productos.edit', $producto->id) }}" class="text-blue-500">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
