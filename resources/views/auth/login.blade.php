<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-700 to-purple-700 flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-extrabold text-blue-700">Iniciar sesión</h2>
            <p class="text-gray-500 text-sm">Compra con un clic</p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="flex justify-end mb-4">
                <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-800">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 transition-all duration-200">
                Iniciar sesión
            </button>
        </form>

        <!-- Línea divisoria -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-3 text-sm text-gray-500">O</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- Botón para registrarse -->
        <a href="{{ route('register') }}"
            class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg py-2 transition-all duration-200">
            Crear cuenta nueva
        </a>
    </div>
</body>
</html>
