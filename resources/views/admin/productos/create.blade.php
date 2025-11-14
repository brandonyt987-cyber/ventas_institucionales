@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Crear Nuevo Producto</h2>

    <form method="POST" action="{{ route('admin.productos.store') }}">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border @error('nombre') border-red-500 @enderror rounded-lg">
            @error('nombre') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="w-full px-4 py-2 border @error('descripcion') border-red-500 @enderror rounded-lg"></textarea>
            @error('descripcion') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
            <input type="text" name="precio" id="precio" class="w-full px-4 py-2 border @error('precio') border-red-500 @enderror rounded-lg">
            @error('precio') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="w-full px-4 py-2 border @error('cantidad') border-red-500 @enderror rounded-lg">
            @error('cantidad') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg">Crear Producto</button>
    </form>
@endsection
