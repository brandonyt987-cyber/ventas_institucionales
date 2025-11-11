@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-8">
    <h1 class="text-2xl font-bold mb-6">🛍️ Crear nuevo producto</h1>

    <form action="{{ route('vendedor.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" class="w-full border-gray-300 rounded-lg" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Precio</label>
            <input type="number" name="precio" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Stock</label>
            <input type="number" name="stock" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Imagen (opcional)</label>
            <input type="file" name="imagen" class="w-full border-gray-300 rounded-lg">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Crear Producto
        </button>
    </form>
</div>
@endsection
