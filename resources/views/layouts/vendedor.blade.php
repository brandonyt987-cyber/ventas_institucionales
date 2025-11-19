<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Vendedor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- NAVBAR VENDEDOR -->
    <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <!-- Logo y título -->
            <div class="flex items-center gap-3">
                <a href="{{ route('vendedor.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                    <h1 class="text-xl font-bold tracking-tight">Ventas Institucionales</h1>
                </a>
            </div>

            <!-- Badge VENDEDOR -->
            <div class="flex items-center gap-4">
                <span class="bg-white text-blue-700 px-4 py-2 rounded-full font-bold text-sm">
                    VENDEDOR
                </span>

                <!-- Botón cerrar sesión -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full font-semibold">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- Submenú de navegación vendedor -->
        <div class="bg-blue-50 text-blue-900 border-t border-blue-200">
            <div class="max-w-7xl mx-auto px-6 py-2 flex justify-start gap-8 text-sm font-medium">
                <a href="{{ route('vendedor.dashboard') }}" class="hover:text-blue-600 transition">📊 Dashboard</a>
                <a href="{{ route('vendedor.productos.index') }}" class="hover:text-blue-600 transition">📦 Productos</a>
                <a href="{{ route('vendedor.clientes.index') }}" class="hover:text-blue-600 transition">👥 Clientes</a>
            </div>
        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- BOTÓN CAMBIAR A CLIENTE -->
    @if(auth()->user()->role === 'cliente' && auth()->user()->modo_vendedor)
        <div class="fixed bottom-4 right-4 z-50">
            <form action="{{ route('modo.vendedor.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full flex items-center gap-2 shadow-lg font-semibold transition">
                    <span class="text-xl">💼</span>
                    <span class="text-sm">Cambiar a Cliente</span>
                </button>
            </form>
        </div>
    @endif

</body>
</html>