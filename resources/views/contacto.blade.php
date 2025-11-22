@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-blue-700 mb-8 text-center">Contáctanos</h1>

    <form id="contactForm" action="{{ route('contacto.enviar') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-lg">
        @csrf

        <!-- NOMBRE -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
            <input type="text" name="nombre" id="nombre"
                value="{{ auth()->user()?->nombre ?? '' }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <span class="text-red-500 text-sm mt-1 hidden" id="error-nombre"></span>
        </div>

        <!-- EMAIL -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
            <input type="email" name="email" id="email"
                value="{{ auth()->user()?->email ?? '' }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <span class="text-red-500 text-sm mt-1 hidden" id="error-email"></span>
        </div>

        <!-- TELÉFONO (solo invitados) -->
        @if(!auth()->check())
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono (Opcional)</label>
            <input type="tel" name="telefono" id="telefono"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <span class="text-red-500 text-sm mt-1 hidden" id="error-telefono"></span>
        </div>
        @endif

        <!-- MENSAJE -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="5"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required></textarea>
            <span class="text-red-500 text-sm mt-1 hidden" id="error-mensaje"></span>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                ✉️ Enviar Mensaje
            </button>
        </div>
    </form>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-center font-semibold">
            ✓ {{ session('success') }}
        </div>
    @endif
</div>

<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {

    let valido = true;

    // Obtener campos
    const nombre   = document.getElementById("nombre");
    const email    = document.getElementById("email");
    const telefono = document.getElementById("telefono");
    const mensaje  = document.getElementById("mensaje");

    // Limpiar errores
    const mostrarError = (id, msg) => {
        const span = document.getElementById(id);
        span.textContent = msg;
        span.classList.remove("hidden");
    };

    const limpiarError = (id) => {
        document.getElementById(id).classList.add("hidden");
    };

    limpiarError("error-nombre");
    limpiarError("error-email");
    limpiarError("error-telefono");
    limpiarError("error-mensaje");

    // === VALIDACIÓN NOMBRE ===
    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/.test(nombre.value)) {
        mostrarError("error-nombre", "El nombre solo puede tener letras.");
        valido = false;
    } else if (nombre.value.trim().length < 3) {
        mostrarError("error-nombre", "El nombre debe tener más de 2 letras.");
        valido = false;
    }

    // === VALIDACIÓN EMAIL ===
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        mostrarError("error-email", "El correo es inválido.");
        valido = false;
    }

    // === VALIDACIÓN TELÉFONO (solo si existe el input) ===
    if (telefono && telefono.value.trim() !== "") {
        if (!/^[0-9]{10}$/.test(telefono.value)) {
            mostrarError("error-telefono", "El teléfono debe tener 10 dígitos.");
            valido = false;
        }
    }

    // === VALIDAR MENSAJE ===
    if (mensaje.value.trim().length === 0) {
        mostrarError("error-mensaje", "El mensaje no puede estar vacío.");
        valido = false;
    }

    if (!valido) e.preventDefault(); // Bloquea el envío
});
</script>

@endsection
