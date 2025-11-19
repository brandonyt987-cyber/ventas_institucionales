@extends('layouts.vendedor')


@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Crear Nuevo Producto</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendedor.productos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <!-- Nombre -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Producto *</label>
            <input 
                type="text" 
                name="nombre" 
                value="{{ old('nombre') }}"
                placeholder="Ej: Laptop Profesional"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                required
            />
        </div>

        <!-- Descripción -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción *</label>
            <textarea 
                name="descripcion" 
                rows="4"
                placeholder="Describe tu producto..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                required
            >{{ old('descripcion') }}</textarea>
        </div>

        <!-- Precio y Stock -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Precio (COP) *</label>

                <!-- 🔵 PRECIO COP CON FORMATO -->
                <input 
                    type="text" 
                    id="precio"
                    name="precio"
                    value="{{ old('precio') }}"
                    placeholder="$0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Stock *</label>
                <input 
                    type="number" 
                    name="stock" 
                    min="0"
                    value="{{ old('stock') }}"
                    placeholder="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
            </div>
        </div>

        <!-- Imagen -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Imagen</label>
            <input 
                type="file" 
                name="imagen" 
                accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
            />
            <p class="text-xs text-gray-500 mt-1">Formatos: JPEG, PNG, JPG, GIF. Máximo: 2MB</p>
        </div>

        <!-- Botones -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                Crear Producto
            </button>
            <a href="{{ route('vendedor.productos.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>

<!-- 🔵 SCRIPT PARA FORMATEAR PRECIO EN COP -->
<script>
const input = document.getElementById('precio');

input.addEventListener('input', function(e) {
    // Permitir solo números
    e.target.value = e.target.value.replace(/\D/g, '');
});

input.addEventListener('blur', function(e) {
    let value = e.target.value.replace(/\D/g, '');

    if (!value) {
        e.target.value = "";
        return;
    }

    // Formato COP solo cuando se sale del input
    e.target.value = new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    }).format(value);
});
</script>


@endsection
