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
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-extrabold text-blue-700">Crear cuenta</h2>
            <p class="text-gray-500 text-sm">Únete para comprar con un clic</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registroForm">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input id="nombre" name="nombre" type="text" minlength="3" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" 
                       title="Solo letras y espacios. Ejemplo: José David"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Apellido -->
            <div class="mb-4">
                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <input id="apellido" name="apellido" type="text" minlength="3" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" 
                       title="Solo letras y espacios. Ejemplo: Pérez Gómez"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <x-input-error :messages="$errors->get('apellido')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" name="email" type="email" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="ejemplo@gmail.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Fecha de nacimiento -->
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       onchange="validateAge()">
                <span id="ageError" class="text-sm text-red-600"></span>
            </div>

            <!-- Teléfono -->
            <div class="mb-4">
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input id="telefono" name="telefono" type="text" maxlength="10" pattern="[0-9]{10}" required 
                       title="Debe contener solo 10 números"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required minlength="8"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        👁️
                    </button>
                </div>

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
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Agregar después del campo de confirmar contraseña -->
            
            <!-- <div>
                <label for="role">Rol</label>
                <select id="role" name="role" required>
                    <option value="cliente">Cliente</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="inventario">Inventario</option>
                    Solo admins pueden crear otros admins, así que omite esta opción o agrégala con lógica 
                </select>
            </div> -->
            

            <!-- Botón -->
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
        togglePassword.addEventListener('click', () => {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
        });

        // Validación visual de la contraseña
        password.addEventListener('input', () => {
            const val = password.value;
            document.getElementById('ruleUpper').classList.toggle('text-green-600', /[A-Z]/.test(val));
            document.getElementById('ruleLower').classList.toggle('text-green-600', /[a-z]/.test(val));
            document.getElementById('ruleNumber').classList.toggle('text-green-600', /\d/.test(val));
            document.getElementById('ruleLength').classList.toggle('text-green-600', val.length >= 8);
        });

        // Validar edad mínima de 13 años
        function validateAge() {
            const birthDate = document.getElementById('fecha_nacimiento').value;
            const birthYear = new Date(birthDate).getFullYear();
            const currentYear = new Date().getFullYear();
            const age = currentYear - birthYear;

            if (age < 13) {
                document.getElementById('ageError').innerText = 'Debes tener al menos 13 años para registrarte.';
            } else {
                document.getElementById('ageError').innerText = '';
            }
        }

        // Mostrar el tipo de rol según el correo
        const emailInput = document.getElementById('email');
        const rolMsg = document.getElementById('rolMsg');
        emailInput.addEventListener('input', () => {
            const email = emailInput.value;
            if (email.includes('@administrador')) {
                rolMsg.textContent = 'Rol detectado: Administrador';
                rolMsg.className = 'text-xs text-blue-600';
            } else if (email.includes('@gmail.com')) {
                rolMsg.textContent = 'Rol detectado: Cliente (acceso a productos)';
                rolMsg.className = 'text-xs text-green-600';
            } else {
                rolMsg.textContent = '';
            }
        });
    </script>
</body>
</html>
