@extends('layouts.app')

@section('title', 'Resultados de búsqueda')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-4">Resultados de búsqueda: "{{ $query }}"</h2>

    @if($productos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($productos as $producto)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    @php
                        $nombreBase = strtolower(str_replace(' ', '', explode(' ', $producto->nombre)[0]));
                        $imagen = $producto->imagen 
                            ? asset('img/' . $producto->imagen)
                            : asset('img/' . $nombreBase . '.jpg');
                    @endphp
                    <img src="{{ $imagen }}" alt="{{ $producto->nombre }}" class="w-full h-40 object-contain rounded mb-3">
                    
                    <h3 class="font-bold text-lg">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($producto->descripcion, 50) }}</p>
                    <p class="text-xl font-bold text-green-700 mb-2">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-4">Stock: {{ $producto->stock }}</p>
                    
                    <a href="{{ route('producto.mostrar', $producto->id) }}" class="block w-full bg-blue-600 text-white px-4 py-2 rounded text-center hover:bg-blue-700 transition">
                        Ver detalles
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">No se encontraron productos con "{{ $query }}"</p>
            <a href="{{ route('inicio') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Volver al inicio
            </a>
        </div>
    @endif
</div>
@endsection