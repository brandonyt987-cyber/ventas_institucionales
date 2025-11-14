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

        @if(session('success'))
            <div class="mb-4 p-3 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 text-red-800 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus value="{{ old('email') }}"
                    class="w-full px-4 py-2 border @error('email') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 border @error('password') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" id="togglePasswordLogin" class="absolute inset-y-0 right-3 flex items-center text-gray-500" aria-label="mostrar contraseña">👁️</button>
                </div>
                @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between items-center mb-4">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-800">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 transition-all duration-200">
                Iniciar sesión
            </button>
        </form>

        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-3 text-sm text-gray-500">O</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <a href="{{ route('register') }}"
            class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg py-2 transition-all duration-200">
            Crear cuenta nueva
        </a>
    </div>

    <script>
        // Toggle password login
        const toggleLogin = document.getElementById('togglePasswordLogin');
        const pwdLogin = document.getElementById('password');
        if (toggleLogin && pwdLogin) {
            toggleLogin.addEventListener('click', () => {
                pwdLogin.type = pwdLogin.type === 'password' ? 'text' : 'password';
            });
        }
    </script>
</body>
</html>
