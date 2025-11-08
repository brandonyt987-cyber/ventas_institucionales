<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas Institucionales</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800">
    <!-- Navbar -->
   <header class="bg-blue-700 text-white px-8 py-4 flex items-center justify-between shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto">
        <h1 class="text-2xl font-bold">Ventas Institucionales</h1>
    </div>

    <!-- Barra de búsqueda -->
    <div class="flex items-center bg-white rounded-full overflow-hidden shadow-sm w-96">
        <input 
            type="text" 
            placeholder="Buscar..." 
            class="px-4 py-2 w-full focus:outline-none text-gray-700"
        >
        <button class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Botón de inicio de sesión -->
    <a href="{{ route('login') }}" 
       class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-2 rounded-lg transition">
        Iniciar Sesión
    </a>
</header>

<!-- Carrusel de información -->
<div class="relative w-full overflow-hidden bg-white shadow-md">
    <!-- Slides -->
    <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
        <!-- Slide 1 -->
        <div class="min-w-full flex flex-col items-center justify-center text-center p-10 bg-blue-100">
            <h2 class="text-3xl font-bold text-blue-700 mb-4">Quienes Somos 🤔🤔</h2>
            <p class="max-w-2xl text-gray-700">
                Somos una empresa dedicada a ofrecer uniformes, kits y materiales institucionales con calidad y compromiso.
            </p>
        </div>

        <!-- Slide 2 -->
        <div class="min-w-full flex flex-col items-center justify-center text-center p-10 bg-blue-50">
            <h2 class="text-3xl font-bold text-blue-700 mb-4">Por Qué Elegirnos</h2>
            <p class="max-w-2xl text-gray-700">
                Somos una empresa dedicada a ofrecer productos institucionales con altos estándares de calidad y compromiso social. Contamos con experiencia en atender instituciones educativas, empresas y entidades públicas.
            </p>
        </div>

        <!-- Slide 3 -->
        <div class="min-w-full flex flex-col items-center justify-center text-center p-10 bg-blue-100">
            <h2 class="text-3xl font-bold text-blue-700 mb-4">Contáctanos</h2>
            <p class="max-w-2xl text-gray-700">
                Puedes comunicarte con nosotros al correo <strong>ventasinstitucionales@gmail.com</strong> o vía WhatsApp 90002431443.
            </p>
        </div>
    </div>

    <!-- Botones de control -->
    <button id="prev" class="absolute left-3 top-1/2 -translate-y-1/2 bg-morado-600 hover:bg-morado-700 text-white p-2 rounded-full">
        ❮
    </button>
    <button id="next" class="absolute right-3 top-1/2 -translate-y-1/2 bg-morado-600 hover:bg-morado-700 text-white p-2 rounded-full">
        ❯
    </button>
</div>

<script>
    const carousel = document.getElementById('carousel');
    const slides = document.querySelectorAll('#carousel > div');
    let index = 0;

    document.getElementById('next').addEventListener('click', () => {
        index = (index + 1) % slides.length;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    document.getElementById('prev').addEventListener('click', () => {
        index = (index - 1 + slides.length) % slides.length;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    // Cambio automático cada 6 segundos
    setInterval(() => {
        index = (index + 1) % slides.length;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 6000);
</script>




    <!-- Hero presentacion-->
    <section class="text-center py-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <h2 class="text-5xl font-extrabold text-blue-700 mb-6 animate-fadeIn">Uniformes, Kits y Materiales Institucionales</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">Calidad y compromiso con las instituciones educativas, empresas y organizaciones. Gestiona tus compras de forma rápida y segura.</p>
        <a href="#productos" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition">Ver productos</a>
    </section>

    <!-- Productos destacados -->
    <section id="productos" class="max-w-6xl mx-auto py-16 px-6">
        <h3 class="text-3xl font-semibold text-center text-blue-700 mb-10">Productos Destacados</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ([
                ['img' => 'https://via.placeholder.com/300', 'titulo' => 'Uniforme Escolar', 'desc' => 'Uniformes cómodos, resistentes y personalizados.'],
                ['img' => 'https://via.placeholder.com/300', 'titulo' => 'Kit Escolar', 'desc' => 'Todo lo que los estudiantes necesitan en un solo paquete.'],
                ['img' => 'https://via.placeholder.com/300', 'titulo' => 'Material Institucional', 'desc' => 'Papelería y materiales de oficina de alta calidad.']
            ] as $producto)
                <div class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-2xl transition transform hover:scale-105 p-6 text-center">
                    <img src="{{ $producto['img'] }}" alt="{{ $producto['titulo'] }}" class="mx-auto mb-4 rounded-lg">
                    <h4 class="font-semibold text-xl text-blue-700">{{ $producto['titulo'] }}</h4>
                    <p class="text-gray-500 mb-4">{{ $producto['desc'] }}</p>
                    <button onclick="alert('Debes iniciar sesión para agregar al carrito')" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-2 rounded-lg font-semibold hover:opacity-90 transition">Agregar al carrito</button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Información institucional -->
    <section class="bg-gradient-to-r from-blue-100 to-purple-100 py-16 text-center">
        <h3 class="text-3xl font-semibold text-blue-700 mb-6">¿Por qué elegirnos?</h3>
        <p class="text-gray-700 max-w-3xl mx-auto mb-8">Somos una empresa dedicada a ofrecer productos institucionales con altos estándares de calidad y compromiso social. Contamos con experiencia en atender instituciones educativas, empresas y entidades públicas.</p>
        <div class="flex flex-wrap justify-center gap-8 mt-8">
            <div class="bg-white shadow-md rounded-xl p-6 w-60 hover:shadow-xl transition">
                <h4 class="font-bold text-blue-700 text-lg mb-2">✔ Calidad garantizada</h4>
                <p class="text-gray-500 text-sm">Trabajamos con materiales certificados y proveedores confiables.</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6 w-60 hover:shadow-xl transition">
                <h4 class="font-bold text-blue-700 text-lg mb-2">🚚 Entregas seguras</h4>
                <p class="text-gray-500 text-sm">Cumplimos con los tiempos de entrega y aseguramos tus pedidos.</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6 w-60 hover:shadow-xl transition">
                <h4 class="font-bold text-blue-700 text-lg mb-2">💬 Atención personalizada</h4>
                <p class="text-gray-500 text-sm">Te acompañamos en cada paso del proceso de compra.</p>
            </div>
        </div>
    </section>

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
    </style>
</body>
</html>
