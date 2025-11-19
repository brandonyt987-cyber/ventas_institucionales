<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Ventas Institucionales')</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen bg-gray-50">

    <!-- 🚀 BOTÓN FLOTANTE CAMBIAR MODO (POST) -->
    @auth
        <form action="{{ route('modo.vendedor.toggle') }}" method="POST"
              style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
            @csrf
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-3 rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-105">
                Cambiar modo
            </button>
        </form>
    @endauth

    <!-- NAVBAR PRINCIPAL -->
    <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ route('inicio') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                    <h1 class="text-xl font-bold tracking-tight">Ventas Institucionales</h1>
                </a>
            </div>

            <!-- Buscador -->
            <div class="flex-1 flex justify-center">
                <form action="{{ route('buscar') }}" method="GET" class="w-full max-w-lg relative">
                    <input 
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Buscar productos..."
                        class="w-full rounded-full py-2 px-4 text-gray-800 focus:outline-none"
                    />
                    <button type="submit"
                        class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-800 hover:bg-blue-900 text-white rounded-full p-2">
                        🔍
                    </button>
                </form>
            </div>

            <!-- Iconos -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('carrito') }}" class="relative flex items-center gap-1">
                        🛒
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 rounded-full">
                            {{ \App\Http\Controllers\CarritoController::contarItems() }}
                        </span>
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="bg-white text-blue-700 px-4 py-2 rounded-full font-semibold hover:bg-blue-100">
                        Mi cuenta
                    </a>
                @else
                    <a href="{{ route('login') }}" class="relative flex items-center gap-1">
                        🛒
                        <span class="absolute -top-2 -right-2 bg-gray-400 text-white text-xs px-2 rounded-full">0</span>
                    </a>
                    <a href="{{ route('login') }}"
                       class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full font-semibold">
                        Iniciar Sesión
                    </a>
                @endauth
            </div>
        </div>

        <!-- Submenú -->
        <div class="bg-blue-50 text-blue-900 border-t border-blue-200">
            <div class="max-w-7xl mx-auto px-6 py-2 flex justify-center gap-6 text-sm font-medium">
                <a href="{{ route('quienes-somos') }}" class="hover:text-blue-600 transition">Quiénes Somos</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('por-que-elegirnos') }}" class="hover:text-blue-600 transition">Por qué Elegirnos</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('contacto') }}" class="hover:text-blue-600 transition">Contáctanos</a>
            </div>

            @auth
                <div class="text-center pb-2">

                </div>
            @endauth

        </div>
    </header>

    <!-- CONTENIDO -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-6 mt-16">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Ventas Institucionales. Todos los derechos reservados.</p>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>
