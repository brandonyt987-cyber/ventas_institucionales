@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="max-w-4xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Contáctanos</h1>

    <form action="{{ route('contacto.enviar') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-lg">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
            <input type="email" name="email" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
            <textarea name="mensaje" rows="4" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold">
                Enviar Mensaje
            </button>
        </div>
    </form>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
