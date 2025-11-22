@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
<div class="container mx-auto py-10">

    <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">

        {{-- Imagen del producto --}}
        @if($producto->imagen)
            <img src="{{ asset('storage/' . $producto->imagen) }}"
                 alt="{{ $producto->nombre }}"
                 class="w-full h-80 object-cover rounded mb-6">
        @endif

        {{-- Nombre --}}
        <h1 class="text-3xl font-bold mb-2">{{ $producto->nombre }}</h1>

        {{-- Descripción --}}
        <p class="text-gray-700 text-lg mb-4">{{ $producto->descripcion }}</p>

        {{-- Precio --}}
        <p class="text-2xl font-semibold text-green-600 mb-4">
            ${{ number_format($producto->precio, 0, ',', '.') }}
        </p>

        {{-- Botones --}}
        <div class="flex space-x-4 mt-4">
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Agregar al carrito
                </button>
            </form>

            <a href="{{ route('inicio') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>

    </div>

</div>
@endsection
