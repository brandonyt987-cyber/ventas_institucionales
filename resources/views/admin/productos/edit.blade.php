@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong class="font-bold">¡Ups! Algo salió mal.</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="block font-semibold mb-2">Nombre *</label>
            <input type="text" name="nombre"
                value="{{ old('nombre', $producto->nombre) }}"
                class="w-full border p-2 rounded @error('nombre') border-red-500 @enderror"
                required>
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label class="block font-semibold mb-2">Descripción *</label>
            <textarea name="descripcion" rows="4"
                class="w-full border p-2 rounded @error('descripcion') border-red-500 @enderror"
                required>{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label class="block font-semibold mb-2">Precio *</label>
            <input type="number" name="precio" min="0" step="0.01"
                value="{{ old('precio', $producto->precio) }}"
                class="w-full border p-2 rounded @error('precio') border-red-500 @enderror"
                required>
            @error('precio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- STOCK CORRECTO --}}
        <div class="mb-3">
            <label class="block font-semibold mb-2">Stock *</label>
            <input type="number" name="stock" min="0"
                value="{{ old('stock', $producto->stock) }}"
                class="w-full border p-2 rounded @error('stock') border-red-500 @enderror"
                required>
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Imagen --}}
        <div class="mb-3">
            <label class="block font-semibold mb-2">Imagen</label>

            @if($producto->imagen)
                <p class="text-sm text-gray-600 mb-1">Imagen actual:</p>
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="w-32 h-32 rounded object-cover mb-2">
            @endif

            <input type="file" name="imagen"
                accept="image/jpeg,image/jpg,image/png"
                class="w-full border p-2 rounded @error('imagen') border-red-500 @enderror">

            @error('imagen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Botones --}}
        <div class="flex gap-3">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Guardar</button>
            <a href="{{ route('admin.productos.index') }}"
                class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancelar</a>
        </div>
    </form>
</div>
@endsection
