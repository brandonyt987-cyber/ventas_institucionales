<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }} - Detalle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('inicio') }}" class="hover:text-blue-200">← Volver</a>
                <h1 class="text-xl font-bold">Detalle del Producto</h1>
            </div>

            <div class="flex items-center space-x-6">
                <span>{{ auth()->user()->nombre ?? 'Invitado' }}</span>

                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
                @endauth
            </div>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-8">

            <div class="grid md:grid-cols-2 gap-8">

                <!-- IMAGEN -->
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg flex items-center justify-center min-h-[350px]">

                    @php
                        $img = $producto->imagen 
                            ? asset('img/' . $producto->imagen)
                            : asset('img/default.jpg');
                    @endphp

                    <img src="{{ $img }}" 
                        alt="{{ $producto->nombre }}"
                        class="max-h-96 object-contain">
                </div>

                <!-- INFORMACIÓN -->
                <div class="flex flex-col justify-between">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $producto->nombre }}</h1>

                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $producto->descripcion }}
                        </p>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center">
                                <span class="text-gray-700 font-semibold w-32">Precio:</span>
                                <span class="text-3xl font-bold text-blue-600">
                                    ${{ number_format($producto->precio, 0, ',', '.') }}
                                </span>
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

                    <!-- BOTONES -->
                    <div class="space-y-3">
                        @if($producto->stock > 0)
                            <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}">
                                @csrf
                                <input type="hidden" name="cantidad" value="1">
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg">
                                    🛒 Agregar al Carrito
                                </button>
                            </form>

                            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg">
                                Comprar Ahora
                            </button>
                        @else
                            <button disabled class="w-full bg-gray-400 text-white font-semibold py-3 rounded-lg">
                                Producto Agotado
                            </button>
                        @endif
                    </div>

                </div>
            </div>

            <!-- OTROS PRODUCTOS -->
            <h2 class="text-2xl font-bold mt-12 mb-4">Otros productos</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($otros as $item)
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">

                        @php
                            $img2 = $item->imagen 
                                ? asset('img/' . $item->imagen)
                                : asset('img/default.jpg');
                        @endphp

                        <img src="{{ $img2 }}" class="h-40 w-full object-contain rounded mb-3">

                        <h3 class="font-semibold text-lg">{{ $item->nombre }}</h3>

                        <p class="text-green-600 font-bold">
                            ${{ number_format($item->precio, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('cliente.producto.show', $producto->id) }}"
                           class="mt-3 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                           Ver producto
                        </a>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

</body>
</html>
