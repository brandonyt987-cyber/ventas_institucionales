@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Editar Usuario</h2>

    <form method="POST" action="{{ route('admin.usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}" class="w-full px-4 py-2 border @error('nombre') border-red-500 @enderror rounded-lg" required>
            @error('nombre')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Apellido -->
        <div class="mb-4">
            <label for="apellido" class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $user->apellido) }}" class="w-full px-4 py-2 border @error('apellido') border-red-500 @enderror rounded-lg" required>
            @error('apellido')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Correo electrónico -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border @error('email') border-red-500 @enderror rounded-lg" required>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Teléfono -->
        <div class="mb-4">
            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}" class="w-full px-4 py-2 border @error('telefono') border-red-500 @enderror rounded-lg" required>
            @error('telefono')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha de nacimiento -->
        <div class="mb-4">
            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" class="w-full px-4 py-2 border @error('fecha_nacimiento') border-red-500 @enderror rounded-lg" required>
            @error('fecha_nacimiento')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón de actualizar -->
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg">Actualizar Usuario</button>
    </form>
@endsection
