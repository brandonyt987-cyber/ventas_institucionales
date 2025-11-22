@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('content')
<div class="mb-10">
    <h2 class="text-4xl font-bold text-gray-800 mb-3">Crear Nuevo Producto</h2>
    <p class="text-gray-600 text-lg">Complete todos los campos para agregar un producto</p>
</div>

<div class="bg-white rounded-3xl shadow-2xl p-10 max-w-4xl mx-auto">
    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div class="mb-8">
            <label class="block text-gray-700 text-lg font-bold mb-3">
                Nombre del Producto <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" 
                   class="w-full px-6 py-4 border-2 rounded-2xl focus:outline-none focus:border-indigo-500 transition @error('nombre') border-red-500 @enderror"
                   placeholder="Ej: Camiseta Premium" required>
            @error('nombre')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-8">
            <label class="block text-gray-700 text-lg font-bold mb-3">
                Descripción <span class="text-red-500">*</span>
            </label>
            <textarea name="descripcion" rows="5" 
                      class="w-full px-6 py-4 border-2 rounded-2xl focus:outline-none focus:border-indigo-500 transition @error('descripcion') border-red-500 @enderror"
                      placeholder="Describe las características del producto..." required>{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Precio y Stock -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <label class="block text-gray-700 text-lg font-bold mb-3">
                    Precio <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-6 top-4 text-gray-600 text-xl">$</span>
                    <input type="number" name="precio" value="{{ old('precio') }}" step="0.01" min="0"
                        class="w-full pl-12 pr-6 py-4 border-2 rounded-2xl focus:outline-none focus:border-indigo-500 transition @error('precio') border-red-500 @enderror"
                        placeholder="0.00" required>
                </div>
                @error('precio')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-lg font-bold mb-3">
                    Stock Inicial <span class="text-red-500">*</span>
                </label>
                <input type="number" name="stock" value="{{ old('stock') }}" min="0"
                    class="w-full px-6 py-4 border-2 rounded-2xl focus:outline-none focus:border-indigo-500 transition @error('stock') border-red-500 @enderror"
                    placeholder="0" required>
                @error('stock')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Imagen -->
        <div class="mb-10">
            <label class="block text-gray-700 text-lg font-bold mb-3">
                Imagen del Producto
            </label>
            <input type="file" name="imagen" accept="image/*"
                class="w-full px-6 py-4 border-2 border-dashed rounded-2xl focus:outline-none focus:border-indigo-500 transition @error('imagen') border-red-500 @enderror">
            <p class="text-gray-500 text-sm mt-3">Formatos: JPG, PNG. Máximo 2MB</p>
            @error('imagen')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-6">
            <a href="{{ route('admin.productos.index') }}" 
            class="px-10 py-4 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition shadow-lg">
                <i class="fas fa-times mr-2"></i> Cancelar
            </a>
            <button type="submit" 
                    class="px-12 py-4 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-2xl hover:from-indigo-700 hover:to-purple-800 transition shadow-xl font-bold text-lg">
                <i class="fas fa-save mr-3"></i> Crear Producto
            </button>
        </div>
    </form>
</div>
@endsection