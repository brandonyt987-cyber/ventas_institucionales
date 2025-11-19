@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-blue-700 mb-8 text-center">Contáctanos</h1>

    <form action="{{ route('contacto.enviar') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-lg">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
            <input type="text" name="nombre" 
                value="{{ auth()->user()?->nombre ?? old('nombre') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
            <input type="email" name="email" 
                value="{{ auth()->user()?->email ?? old('email') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if(!auth()->check())
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono (Opcional)</label>
            <input type="tel" name="telefono" 
                value="{{ old('telefono') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        @endif

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Mensaje</label>
            <textarea name="mensaje" rows="5" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>{{ old('mensaje') }}</textarea>
            @error('mensaje') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                ✉️ Enviar Mensaje
            </button>
        </div>
    </form>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-center font-semibold">
            ✓ {{ session('success') }}
        </div>
    @endif
</div>
@endsection