<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }} - Detalle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('cliente.dashboard') }}" class="hover:text-blue-200">
                    ← Volver
                </a>
                <h1 class="text-xl font-bold">Detalle del Producto</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <span>{{ auth()->user()->nombre }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Detalle del Producto -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Imagen -->
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg flex items-center justify-center" style="min-height: 400px;">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             alt="{{ $producto->nombre }}" 
                             class="max-h-96 object-contain">
                    @else
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    @endif
                </div>

                <!-- Información -->
                <div class="flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $producto->nombre }}</h1>
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $producto->descripcion }}</p>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center">
                                <span class="text-gray-700 font-semibold w-32">Precio:</span>
                                <span class="text-3xl font-bold text-blue-600">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-700 font-semibold w-32">Stock:</span>
                                <span class="text-lg {{ $producto->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-700 font-semibold w-32">Categoría:</span>
                                <span class="text-gray-600">{{ $producto->categoria ?? 'General' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="space-y-3">
                        @if($producto->stock > 0)
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                                Agregar al Carrito
                            </button>
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                                Comprar Ahora
                            </button>
                        @else
                            <button disabled class="w-full bg-gray-400 text-white font-semibold py-3 rounded-lg cursor-not-allowed">
                                Producto Agotado
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>