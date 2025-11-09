@extends('layouts.app')

@section('title', 'Contáctanos - Ventas Institucionales')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Contáctanos
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <h1 class="text-4xl font-extrabold text-blue-700 mb-8 text-center">Solicita una Cotización Personalizada</h1>

    <div class="grid md:grid-cols-2 gap-12">
        <!-- Formulario de Contacto -->
        <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Envíanos tu solicitud</h2>
            
            <!-- Asegúrate de crear el controlador y la ruta para manejar el envío -->
            <form action="#" method="POST" class="space-y-4">
                @csrf 
                <input type="text" name="nombre" placeholder="Nombre de la institución o contacto" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                
                <input type="email" name="email" placeholder="Correo electrónico institucional" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                
                <input type="tel" name="telefono" placeholder="Teléfono de contacto (Opcional)"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                
                <textarea name="mensaje" placeholder="Describe los productos, cantidades y plazos de entrega que necesitas." rows="6" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"></textarea>
                
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-md">
                    <i class="fas fa-paper-plane mr-2"></i> Enviar Solicitud de Cotización
                </button>
            </form>
        </div>

        <!-- Información de Contacto Directa -->
        <div class="contact-info-area p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Datos de Contacto</h2>
            <div class="space-y-4 text-lg text-gray-700 dark:text-gray-300">
                <p><i class="fas fa-map-marker-alt text-blue-600 mr-3"></i> **Dirección:** [Tu Calle y Ciudad]</p>
                <p><i class="fas fa-phone text-blue-600 mr-3"></i> **Línea Nacional:** [Tu Teléfono]</p>
                <p><i class="fas fa-envelope text-blue-600 mr-3"></i> **Email de Ventas:** <a href="mailto:ventas@institucionales.com" class="text-blue-600 hover:text-blue-800">ventas@institucionales.com</a></p>
            </div>
            
            <h3 class="text-xl font-semibold mt-8 mb-3 text-gray-800 dark:text-gray-200">Horario de Atención</h3>
            <p class="text-gray-600 dark:text-gray-400">Lunes a Viernes: 8:00 AM - 5:00 PM</p>

            <div class="mt-8 bg-gray-200 dark:bg-gray-700 h-48 rounded-xl flex items-center justify-center text-gray-500 text-sm shadow-inner">
                [Espacio para Mapa de Google Maps Embed]
            </div>
        </div>
    </div>
</div>
@endsection