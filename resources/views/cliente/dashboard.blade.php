@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">

    <h1 class="text-3xl font-bold mb-6">Productos Disponibles</h1>

    @if($productos->isEmpty())
        <p class="text-gray-600">No hay productos disponibles.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($productos as $producto)
                <div class="bg-white rounded-xl shadow-md p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $producto->nombre }}</h2>
                    <p class="text-gray-700 mb-2">{{ $producto->descripcion }}</p>
                    <p class="font-semibold">Stock: {{ $producto->stock }}</p>
                    <p class="font-semibold">Precio: ${{ $producto->precio }}</p>

                    <a href="{{ route('cliente.producto.show', $producto->id) }}"
                        class="mt-3 block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Ver Detalles
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
