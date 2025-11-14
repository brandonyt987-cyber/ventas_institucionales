<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendedor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

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

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard de Vendedor</h2>
            <p class="text-gray-600">Gestiona tus productos y clientes desde tu panel principal.</p>
        </div>

        <!-- GRID DE TARJETAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Tarjeta: Mis Clientes -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                <div class="text-5xl mb-4">👥</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mis Clientes</h3>
                <p class="text-gray-600 text-sm mb-6">Ver tus clientes registrados</p>
                <a href="{{ route('vendedor.clientes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                    Ver Clientes
                </a>
            </div>

            <!-- Tarjeta: Ver Productos -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                <div class="text-5xl mb-4">📦</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Ver Productos</h3>
                <p class="text-gray-600 text-sm mb-6">Consulta y administra tus productos</p>
                <a href="{{ route('vendedor.productos.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                    Ver Productos
                </a>
            </div>

            <!-- Tarjeta: Nuevo Producto -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                <div class="text-5xl mb-4">🛒</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Nuevo Producto</h3>
                <p class="text-gray-600 text-sm mb-6">Agrega un nuevo producto al catálogo</p>
                <a href="{{ route('vendedor.productos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition inline-block">
                    Agregar Producto
                </a>
            </div>

        </div>
    </main>

    <!-- BOTÓN CAMBIAR A CLIENTE (Solo si es CLIENTE en modo vendedor) -->
    @if(auth()->user()->role === 'cliente' && auth()->user()->modo_vendedor)
        <div class="fixed bottom-4 right-4 z-50">
            <form action="{{ route('vendedor.cambiarModo') }}" method="POST">
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