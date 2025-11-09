<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas Institucionales</title>
    @vite('resources/css/app.css')
    
    <!-- Asegúrate de incluir Font Awesome si no estás usando el layout principal 
         aunque ya lo pusimos en app.blade.php, lo mantenemos por si usas 'welcome' sin 'app'.
    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/CDQ+09fC3J4Qn2z5c1cM3P92/d1E4A9i4j2n0wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-white text-gray-800">
    <!-- Navbar -->
    <header class="bg-blue-700 text-white px-8 py-4 flex items-center justify-between shadow-md">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto">
            <h1 class="text-2xl font-bold">Ventas Institucionales</h1>
        </div>

        <!-- Barra de búsqueda mejorada (con icono ya incluido) -->
        <form action="{{ route('buscar') }}" method="GET" class="flex items-center bg-white rounded-full overflow-hidden shadow-sm w-96">
            <input 
                type="text" 
                name="q"
                placeholder="Buscar productos..." 
                class="px-4 py-2 w-full focus:outline-none text-gray-700"
                required
            >
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 transition">
                <i class="fas fa-search"></i> <!-- Icono de lupa -->
            </button>
        </form>

        <!-- Inicio de sesión -->
        <a href="{{ route('login') }}" 
        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-2 rounded-lg transition">
            Iniciar Sesión
        </a>
    </header>

    <!-- Enlaces de Navegación (Quiénes Somos, Por qué elegirnos, Contáctanos) -->
    <nav class="bg-blue-50 border-t border-b border-gray-200 py-3 shadow-sm">
        <div class="max-w-6xl mx-auto flex flex-wrap justify-center space-x-4 text-sm md:text-base text-blue-900 font-medium">
            
            <a href="{{ route('quienes-somos') }}" class="hover:text-purple-600 transition">
            Quiénes somos
            </a>
            <span class="text-gray-400">|</span>

            <a href="{{ route('por-que-elegirnos') }}" class="hover:text-purple-600 transition">
            Por qué elegirnos
            </a>
            <span class="text-gray-400">|</span>

            <a href="{{ route('contacto') }}" class="hover:text-purple-600 transition">
            Contáctanos
            </a>
        </div>
    </nav>

    <!-- h presentacion-->
    <section class="text-center py-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <h2 class="text-5xl font-extrabold text-blue-700 mb-6 animate-fadeIn">Uniformes, Kits y Materiales Institucionales</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">Calidad y compromiso con las instituciones educativas, empresas y organizaciones. Gestiona tus compras de forma rápida y segura.</p>
        <a href="#productos" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition">Ver productos</a>
    </section>

    <!-- Productos destacados -->
    <section id="productos" class="max-w-6xl mx-auto py-16 px-6">
    <h3 class="text-3xl font-semibold text-blue-700 mb-10">Productos destacados</h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ([
        [
            'img' => 'https://via.placeholder.com/250x180',
            'categoria' => 'Servilletas para restaurantes y negocios',
            'ref' => '72677+80137',
            'titulo' => 'Servilleta Plus Natural',
            'descripcion' => 'Mayor rendimiento gracias a su sistema de dispensado que evita el consumo excesivo.',
        ],
        [
            'img' => 'https://via.placeholder.com/250x180',
            'categoria' => 'Gel Antibacterial para manos',
            'ref' => '80096+83201',
            'titulo' => 'Gel Antibacterial repuesto 1.000 mL',
            'descripcion' => 'Elimina el 99.9% de bacterias y contiene humectantes que cuidan la piel.',
        ],
        [
            'img' => 'https://via.placeholder.com/250x180',
            'categoria' => 'Toallas de papel',
            'ref' => '73575+83150',
            'titulo' => 'Toalla de Manos Flujo Central Famimax 100m',
            'descripcion' => 'Máximo rendimiento con hojas de alta absorción, resistencia y suavidad.',
        ]
        ] as $producto)
        <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition overflow-hidden p-6 flex flex-col justify-between">
        
        <!-- Imagen -->
        <div class="flex justify-center mb-4">
            <img src="{{ $producto['img'] }}" alt="{{ $producto['titulo'] }}" class="h-36 object-contain">
        </div>

        <!-- Información -->
        <div class="text-left mb-6">
            <p class="text-sm text-blue-600 font-medium mb-1">{{ $producto['categoria'] }}</p>
            <p class="text-sm text-gray-500 mb-1">Ref: {{ $producto['ref'] }}</p>
            <h4 class="font-bold text-blue-800 mb-2 text-lg">{{ $producto['titulo'] }}</h4>
            <p class="text-gray-600 text-sm">{{ $producto['descripcion'] }}</p>
        </div>

        <!-- Botón -->
        <div class="text-center">
            <a href="{{ route('productos') }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold transition">
            Ver producto
            </a>
        </div>
        </div>
        @endforeach

    </div>
    </section>
    
    <!-- === SECCIÓN DE TESTIMONIOS (INSERCIÓN) === -->
    @include('partials.testimonios_section')
    <!-- ========================================== -->


    <!-- Botón flotante del carrito con contador (Mejorado) -->
    <a href="{{ route('carrito') }}" 
    class="fixed bottom-6 right-6 bg-purple-600 hover:bg-purple-700 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-2xl transition transform hover:scale-110 z-50 relative">
        <i class="fas fa-shopping-cart text-2xl"></i>
        <!-- Contador de artículos (simulado con el número 3 por ahora) -->
        <span class="cart-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-white">
            3
        </span>
    </a>


    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-6 mt-16">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Ventas Institucionales. Todos los derechos reservados.</p>
        </div>
    </footer>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out;
        }


        <!-- La sección se inyectará en welcome.blade.php -->
<section class="max-w-6xl mx-auto py-16 px-6 bg-gray-50 dark:bg-gray-800 rounded-xl shadow-lg mt-16">
    <h3 class="text-3xl font-bold text-center text-purple-700 dark:text-purple-400 mb-12">Lo que Nuestros Clientes Dicen</h3>
    
    <!-- Simulacro de datos de Testimonios (reemplazar con datos reales de la BD) -->
    @php
        $testimonios = [
            [
                'texto' => 'La gestión logística para la entrega de uniformes fue impecable. Recibimos más de 500 kits a tiempo y con la calidad prometida.',
                'cliente' => 'María G.',
                'empresa' => 'Colegio San Ignacio',
                'puntuacion' => 5
            ],
            [
                'texto' => 'Su capacidad de respuesta en el suministro de materiales de higiene fue crucial durante el pico de demanda. Un socio estratégico confiable.',
                'cliente' => 'Roberto V.',
                'empresa' => 'Hospital Metropolitano',
                'puntuacion' => 5
            ],
            [
                'texto' => 'Excelente calidad en los bordados de nuestros logos. El servicio al cliente siempre atento a los detalles de la personalización.',
                'cliente' => 'Ana S.',
                'empresa' => 'Empresa de Tecnología "Innovatech"',
                'puntuacion' => 4.5
            ]
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($testimonios as $testimonio)
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-xl border-t-4 border-purple-500 flex flex-col justify-between">
                <div>
                    <!-- Icono de Citas -->
                    <i class="fas fa-quote-left text-2xl text-purple-400 mb-3"></i>
                    
                    <p class="italic text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">"{{ $testimonio['texto'] }}"</p>
                </div>
                
                <div class="mt-4 border-t pt-4 border-gray-100 dark:border-gray-700">
                    <p class="font-bold text-gray-800 dark:text-gray-200">{{ $testimonio['cliente'] }}</p>
                    <p class="text-sm text-purple-600 dark:text-purple-400">{{ $testimonio['empresa'] }}</p>
                    
                    <!-- Puntuación (Estrellas) -->
                    <div class="flex mt-2">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($testimonio['puntuacion'] > $i)
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-gray-300 dark:text-gray-600"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- CTA para más confianza -->
    <div class="text-center mt-12">
        <a href="{{ route('contacto') }}" class="text-purple-600 font-semibold hover:text-purple-800 transition">
            <i class="fas fa-check-circle mr-2"></i> Únete a nuestra lista de clientes satisfechos
        </a>
    </div>
</section>
    </style>
</body>
</html>