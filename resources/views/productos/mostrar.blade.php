@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col md:flex-row">
        <div class="md:w-1/2 flex justify-center items-center p-6">
        @php
                if ($producto->imagen) {
                    $imagen = asset('storage/' . $producto->imagen);
                } else {
                    $nombreBase = strtolower(str_replace(' ', '', explode(' ', $producto->nombre)[0]));
                    $imagen = asset('img/' . $nombreBase . '.jpg');
                }
        @endphp

            <img src="{{ $imagen }}" alt="{{ $producto->nombre }}" class="w-64 h-64 object-contain">
        </div>

        <div class="md:w-1/2 p-6 flex flex-col justify-center">
            <h1 class="text-3xl font-bold text-blue-700 mb-4">{{ $producto->nombre }}</h1>
            <p class="text-gray-600 mb-6">{{ $producto->descripcion }}</p>
            <p class="text-2xl font-semibold text-green-700 mb-6">
                ${{ number_format($producto->precio, 0, ',', '.') }}
            </p>

            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" class="flex gap-3">
                @csrf
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    🛒 Agregar al carrito
                </button>
                <a href="{{ route('inicio') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                    ← Volver
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
