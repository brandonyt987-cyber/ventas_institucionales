@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto py-16 px-6">
    <h2 class="text-3xl font-semibold text-blue-700 mb-6">
        Resultados de búsqueda para: "{{ $query }}"
    </h2>

    @if($productos->isEmpty())
        <p class="text-gray-500">No se encontraron productos que coincidan con tu búsqueda.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($productos as $producto)
                <div class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-2xl transition transform hover:scale-105 p-6 text-center">
                    <img src="{{ $producto->imagen ? asset('storage/'.$producto->imagen) : 'https://via.placeholder.com/300' }}" 
                        alt="{{ $producto->nombre }}" class="mx-auto mb-4 rounded-lg">
                    <h4 class="font-semibold text-xl text-blue-700">{{ $producto->nombre }}</h4>
                    <p class="text-gray-500 mb-2">{{ $producto->descripcion }}</p>
                    <p class="font-bold text-blue-600 mb-4">$ {{ number_format($producto->precio, 2) }}</p>
                    <button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                        Agregar al carrito
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
