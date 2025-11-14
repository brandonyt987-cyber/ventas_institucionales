<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-700 to-purple-700 flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-extrabold text-blue-700">Crear cuenta</h2>
            <p class="text-gray-500 text-sm">Únete para comprar con un clic</p>
        </div>

        {{-- Mensajes flash --}}
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

        <form method="POST" action="{{ route('register') }}" id="registroForm" novalidate>
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" minlength="3" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" 
                       title="Solo letras y espacios. Ejemplo: José David"
                       class="w-full px-4 py-2 border @error('nombre') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nombre') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Apellido -->
            <div class="mb-4">
                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <input id="apellido" name="apellido" type="text" value="{{ old('apellido') }}" minlength="3" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s+" 
                       title="Solo letras y espacios. Ejemplo: Pérez Gómez"
                       class="w-full px-4 py-2 border @error('apellido') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('apellido') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                       class="w-full px-4 py-2 border @error('email') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="ejemplo@gmail.com">
                @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Fecha de nacimiento -->
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento') }}" required 
                       class="w-full px-4 py-2 border @error('fecha_nacimiento') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       onchange="validateAge()">
                @error('fecha_nacimiento') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                <span id="ageError" class="text-sm text-red-600"></span>
            </div>

            <!-- Teléfono -->
            <div class="mb-4">
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}" maxlength="10" pattern="[0-9]{10}" required 
                       title="Debe contener solo 10 números"
                       class="w-full px-4 py-2 border @error('telefono') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('telefono') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required minlength="8"
                        class="w-full px-4 py-2 border @error('password') border-red-500 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500" aria-label="mostrar contraseña">
                        👁️
                    </button>
                </div>
                @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                <ul class="text-xs mt-2 text-gray-600" id="passwordRules">
                    <li id="ruleUpper" class="text-red-500">Debe tener una letra mayúscula (A-Z)</li>
                    <li id="ruleLower" class="text-red-500">Debe tener una letra minúscula (a-z)</li>
                    <li id="ruleNumber" class="text-red-500">Debe tener un número (0-9)</li>
                    <li id="ruleLength" class="text-red-500">Mínimo 8 caracteres</li>
                </ul>
            </div>

            <!-- Confirmación -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 transition-all duration-200">
                Registrarme
            </button>

            <p class="text-sm text-center mt-4 text-gray-600">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-semibold">Inicia sesión</a>
            </p>
        </form>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        if (togglePassword && password) {
            togglePassword.addEventListener('click', () => {
                password.type = password.type === 'password' ? 'text' : 'password';
            });
        }

        // Validación visual de la contraseña
        if (password) {
            password.addEventListener('input', () => {
                const val = password.value;
                document.getElementById('ruleUpper').classList.toggle('text-green-600', /[A-Z]/.test(val));
                document.getElementById('ruleLower').classList.toggle('text-green-600', /[a-z]/.test(val));
                document.getElementById('ruleNumber').classList.toggle('text-green-600', /\d/.test(val));
                document.getElementById('ruleLength').classList.toggle('text-green-600', val.length >= 8);
            });
        }

        // Validar edad (front)
        function validateAge() {
            const birthDate = document.getElementById('fecha_nacimiento').value;
            if (!birthDate) return;
            const age = new Date().getFullYear() - new Date(birthDate).getFullYear();
            document.getElementById('ageError').innerText = (age < 18) ? 'Debes tener al menos 18 años para registrarte.' : '';
        }
    </script>
</body>
</html>
