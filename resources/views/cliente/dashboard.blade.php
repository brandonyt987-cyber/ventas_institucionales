<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

        <!-- NAVBAR PRINCIPAL -->
        <header class="bg-blue-700 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
                <!-- Logo y título -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('inicio') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                        <h1 class="text-xl font-bold tracking-tight">Ventas Institucionales</h1>
                    </a>
                </div>

                <!-- Buscador centrado -->
                <div class="flex-1 flex justify-center">
                    <form action="{{ route('buscar') }}" method="GET" class="w-full max-w-lg relative">
                        <input 
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Buscar productos..."
                            class="w-full rounded-full py-2 px-4 text-gray-800 focus:outline-none"
                        />
                        <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-800 hover:bg-blue-900 text-white rounded-full p-2">
                            🔍
                        </button>
                    </form>
                </div>

                <!-- Iconos: carrito y botón cerrar sesión -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('carrito') }}" class="relative flex items-center gap-1">
                        🛒
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 rounded-full">
                            {{ \App\Http\Controllers\CarritoController::contarItems() }}
                        </span>
                    </a>

                    <!-- Botón cerrar sesión -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full font-semibold">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Submenú: enlaces informativos -->
            <div class="bg-blue-50 text-blue-900 border-t border-blue-200">
                <div class="max-w-7xl mx-auto px-6 py-2 flex justify-center gap-6 text-sm font-medium">
                    <a href="{{ route('quienes-somos') }}" class="hover:text-blue-600 transition">Quiénes Somos</a>
                    <span class="text-gray-400">|</span>
                    <a href="{{ route('por-que-elegirnos') }}" class="hover:text-blue-600 transition">Por qué Elegirnos</a>
                    <span class="text-gray-400">|</span>
                    <a href="{{ route('contacto') }}" class="hover:text-blue-600 transition">Contáctanos</a>
                </div>
            </div>
        </header>


<!-- Espacio para que el contenido no quede cubierto por el navbar fijo -->
<div class="h-20"></div>


    <!-- CONTENIDO PRINCIPAL -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Catálogo de Productos</h2>
            <p class="text-gray-600">Explora nuestra selección de productos institucionales</p>
        </div>

        <!-- GRID DE PRODUCTOS -->
        @if($productos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($productos as $producto)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        <!-- Imagen del producto -->
                        <div class="h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                    alt="{{ $producto->nombre }}" 
                                    class="h-full w-full object-cover">
                            @else
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            @endif
                        </div>

                        <!-- Información del producto -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                            
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-bold text-blue-600">
                                    ${{ number_format($producto->precio, 0, ',', '.') }}
                                </span>
                                <span class="text-sm {{ $producto->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    Stock: {{ $producto->stock }}
                                </span>
                            </div>

                            <div class="space-y-2">
                                <a href="{{ route('cliente.producto.show', $producto->id) }}" 
                                class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 rounded-lg transition text-sm">
                                    Ver Detalles
                                </a>
                                
                                @if($producto->stock > 0)
                                    <form action="{{ route('cliente.carrito.agregar', $producto->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cantidad" value="1">
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                                            🛒 Agregar al Carrito
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">
                                        Sin Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay productos disponibles</h3>
                <p class="text-gray-500">Pronto agregaremos nuevos productos al catálogo</p>
            </div>
        @endif
    </div>

</body>
</html>
