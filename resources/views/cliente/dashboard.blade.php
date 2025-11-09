<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold">Ventas Institucionales</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <span>Hola, <strong>{{ auth()->user()->nombre }}</strong></span>
                <span class="bg-blue-800 px-3 py-1 rounded-full text-sm">Cliente</span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!--- carritto-->
    <div class="flex items-center space-x-6">
    <!-- Carrito -->
    <a href="{{ route('cliente.carrito') }}" class="relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        @php
            $itemsEnCarrito = \App\Http\Controllers\CarritoController::contarItems();
        @endphp
        @if($itemsEnCarrito > 0)
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                {{ $itemsEnCarrito }}
            </span>
        @endif
    </a>
    
    <span>Hola, <strong>{{ auth()->user()->nombre }}</strong></span>
    <span class="bg-blue-800 px-3 py-1 rounded-full text-sm">Cliente</span>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
            Cerrar Sesión
        </button>
    </form>
</div>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Catálogo de Productos</h2>
            <p class="text-gray-600">Explora nuestra selección de productos institucionales</p>
        </div>

        <!-- Grid de Productos -->
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
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($producto->precio, 0, ',', '.') }}</span>
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