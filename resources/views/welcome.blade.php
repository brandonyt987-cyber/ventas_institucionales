@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<!-- Sección de presentación -->
<section class="text-center py-20 bg-gradient-to-r from-blue-50 to-purple-50">
    <h2 class="text-5xl font-extrabold text-blue-700 mb-6 animate-fadeIn">
        Uniformes, Kits y Materiales Institucionales
    </h2>
    <p class="text-gray-600 max-w-2xl mx-auto mb-8">
        Calidad y compromiso con las instituciones educativas, empresas y organizaciones. 
        Gestiona tus compras de forma rápida y segura.
    </p>
    <a href="#productos" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition">
        Ver productos
    </a>
</section>

<!-- Productos destacados -->
<section id="productos" class="py-12">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">Productos destacados</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach($productos as $producto)
            <div class="bg-white shadow-md rounded-2xl p-6 flex flex-col items-center text-center">
                        @php
                // Si el producto tiene imagen en la base de datos, la usa. Si no, intenta deducirla según el nombre
                $nombreBase = strtolower(str_replace(' ', '', explode(' ', $producto->nombre)[0]));
                $imagen = $producto->imagen 
                    ? asset('images/' . $producto->imagen)
                    : asset('images/' . $nombreBase . '.jpg');
            @endphp

            <img 
                src="{{ $imagen }}" 
                alt="{{ $producto->nombre }}" 
                class="w-32 h-32 mx-auto mb-4 object-contain rounded-lg shadow-sm">
                <p class="text-gray-500 text-sm mt-2">{{ $producto->descripcion }}</p>
                <p class="text-blue-600 font-bold mt-3">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                
                <div class="mt-4 flex gap-2">
                <a href="{{ route('producto.mostrar', $producto->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition"> Ver producto</a>
                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                            Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Testimonios -->
<section id="testimonios" class="bg-gray-100 py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-10 text-blue-700">Testimonios de nuestros clientes</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p class="italic">"Excelente servicio y atención al cliente."</p>
                <h4 class="mt-4 font-semibold text-purple-600">Juan Pérez</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p class="italic">"Productos de muy buena calidad, 100% recomendado."</p>
                <h4 class="mt-4 font-semibold text-purple-600">Ana Gómez</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p class="italic">"El envío fue rápido y el producto superó mis expectativas."</p>
                <h4 class="mt-4 font-semibold text-purple-600">Carlos Rodríguez</h4>
            </div>
        </div>
    </div>
</section>


<!-- Animaciones -->
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 1s ease-in-out;
}
</style>

@endsection
