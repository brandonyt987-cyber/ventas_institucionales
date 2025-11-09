@extends('layouts.app')

@section('title', 'Quiénes Somos - Ventas Institucionales')

<!-- Incluye el encabezado de Laravel Breeze/Jetstream si lo estás usando -->
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Quiénes Somos
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <h1 class="text-4xl font-extrabold text-blue-700 mb-6">Nuestra Historia y Compromiso con la Calidad</h1>
    
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <!-- Columna de Contenido -->
        <div>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">
                Fundada en la promesa de **calidad y eficiencia**, Ventas Institucionales nació para simplificar la gestión de compras de uniformes, kits de higiene y materiales para grandes organizaciones. Entendemos que su tiempo es valioso, por eso ofrecemos soluciones logísticas completas y productos de máxima durabilidad.
            </p>

            <!-- Misión y Visión -->
            <div class="space-y-6">
                <div class="p-4 bg-blue-50 dark:bg-gray-700 rounded-lg shadow-sm">
                    <h3 class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-2">Misión</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Ser el proveedor estratégico que garantiza la uniformidad y el suministro de materiales esenciales, contribuyendo al profesionalismo y operación fluida de cada institución que servimos.
                    </p>
                </div>
                <div class="p-4 bg-purple-50 dark:bg-gray-700 rounded-lg shadow-sm">
                    <h3 class="text-xl font-bold text-purple-600 dark:text-purple-400 mb-2">Visión</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Liderar el mercado institucional a través de la innovación logística y la excelencia en el servicio al cliente, estableciendo el estándar de oro en la distribución a gran escala.
                    </p>
                </div>
            </div>
        </div>

        <!-- Columna de Imagen/Video -->
        <div class="flex justify-center">
            <!-- Placeholder de Imagen Institucional -->
            <div class="bg-gray-200 dark:bg-gray-700 w-full h-64 rounded-xl flex items-center justify-center text-gray-500 dark:text-gray-400 text-sm shadow-inner">
                [Imagen Institucional del Equipo]
            </div>
        </div>
    </div>
</div>
@endsection