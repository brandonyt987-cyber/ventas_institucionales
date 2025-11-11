<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendedor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- NAVBAR PRINCIPAL -->
    <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <!-- Logo y título -->
            <div class="flex items-center gap-3">
                <a href="{{ route('vendedor.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                    <h1 class="text-xl font-bold tracking-tight">Panel de Ventas</h1>
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
                    <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 text-white rounded-full p-2">
                        🔍
                    </button>
                </form>
            </div>

            <!-- Botones: Rol y cerrar sesión -->
            <div class="flex items-center gap-4">
                <span class="bg-white text-blue-700 px-3 py-1 rounded-full text-sm font-bold uppercase">
                    Vendedor
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

        <!-- Submenú -->
        <div class="bg-blue-50 text-blue-900 border-t border-blue-200">
            <div class="max-w-7xl mx-auto px-6 py-2 flex justify-center gap-6 text-sm font-medium">
                <a href="{{ route('vendedor.productos.index') }}" class="hover:text-blue-700 transition">Ver Productos</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('vendedor.productos.create') }}" class="hover:text-blue-700 transition">Agregar Producto</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('vendedor.venta') }}" class="hover:text-blue-700 transition">Mis Ventas</a>
            </div>
        </div>
    </header>

    <!-- Espacio para que el contenido no quede cubierto por el navbar -->
    <div class="h-20"></div>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard de Ventas</h2>
        <p class="text-gray-600 mb-10">Gestiona tus ventas y productos desde tu panel principal.</p>

        <!-- MÉTRICAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center border border-blue-100">
                <span class="text-4xl text-green-600 mb-2">💵</span>
                <h3 class="text-lg font-semibold text-gray-700">Ventas Hoy</h3>
                <p class="text-2xl font-bold text-gray-900 mt-2">$0</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center border border-blue-100">
                <span class="text-4xl text-blue-600 mb-2">👥</span>
                <h3 class="text-lg font-semibold text-gray-700">Mis Clientes</h3>
                <p class="text-2xl font-bold text-gray-900 mt-2">1</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center border border-blue-100">
                <span class="text-4xl text-purple-600 mb-2">📦</span>
                <h3 class="text-lg font-semibold text-gray-700">Productos</h3>
                <p class="text-2xl font-bold text-gray-900 mt-2">3</p>
            </div>
        </div>

        <!-- ACCIONES -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col items-center justify-center text-center hover:shadow-xl transition border border-blue-100">
                <a href="#" class="text-5xl text-green-500 mb-3">➕</a>
                <h3 class="text-xl font-semibold text-gray-800">Nueva Venta</h3>
                <p class="text-gray-500 mt-2">Registrar una nueva venta</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col items-center justify-center text-center hover:shadow-xl transition border border-blue-100">
                <a href="{{ route('vendedor.productos.index') }}" class="text-5xl text-blue-500 mb-3">📋</a>
                <h3 class="text-xl font-semibold text-gray-800">Ver Productos</h3>
                <p class="text-gray-500 mt-2">Catálogo de productos</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col items-center justify-center text-center hover:shadow-xl transition border border-blue-100">
                <a href="{{ route('vendedor.productos.create') }}" class="text-5xl text-purple-500 mb-3">🛍️</a>
                <h3 class="text-xl font-semibold text-gray-800">Nuevo Producto</h3>
                <p class="text-gray-500 mt-2">Registrar un nuevo producto</p>
            </div>
        </div>
    </main>

</body>
</html>
