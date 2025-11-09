@extends('layouts.app')

@section('title', 'Por Qué Elegirnos - Ventas Institucionales')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Por Qué Elegirnos
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-8 text-center">Nuestras Ventajas Únicas</h1>

    <div class="grid md:grid-cols-3 gap-8 text-center">
        
        <!-- Ventaja 1: Logística Rápida -->
        <div class="p-6 bg-blue-50 dark:bg-gray-700 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
            <i class="fas fa-truck-fast text-5xl text-blue-600 dark:text-blue-400 mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Logística sin Complicaciones</h3>
            <p class="text-gray-600 dark:text-gray-400">
                Entregas a tiempo garantizadas a nivel nacional. Nos encargamos de la gestión completa para que usted se enfoque en su operación.
            </p>
        </div>

        <!-- Ventaja 2: Ahorro por Volumen -->
        <div class="p-6 bg-blue-50 dark:bg-gray-700 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
            <i class="fas fa-hand-holding-dollar text-5xl text-blue-600 dark:text-blue-400 mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">El Mejor Precio Institucional</h3>
            <p class="text-gray-600 dark:text-gray-400">
                Acceda a precios de fábrica y cotizaciones exclusivas diseñadas para compras de alto volumen. Máximo valor, mínimo costo.
            </p>
        </div>

        <!-- Ventaja 3: Personalización -->
        <div class="p-6 bg-blue-50 dark:bg-gray-700 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
            <i class="fas fa-palette text-5xl text-blue-600 dark:text-blue-400 mb-4"></i>
            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Kits y Uniformes a Medida</h3>
            <p class="text-gray-600 dark:text-gray-400">
                Personalización total: bordado de logos, tallas especiales y empaquetado de kits listos para distribuir.
            </p>
        </div>

    </div>

    <!-- Llamada a la Acción -->
    <div class="mt-12 text-center p-8 bg-purple-100 dark:bg-gray-700 rounded-xl">
        <h3 class="text-2xl font-bold text-purple-700 dark:text-purple-400 mb-4">¿Listo para cotizar?</h3>
        <a href="{{ route('contacto') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-full font-bold shadow-md hover:bg-purple-700 transition transform hover:scale-105">
            Comienza tu Cotización Ahora
        </a>
    </div>

</div>
@endsection