@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
<h2 class="text-3xl font-bold text-gray-800 mb-4">Lista de Usuarios</h2>
<table class="w-full border-collapse">
    <thead>
        <tr>
            <th class="px-4 py-2 text-left border-b">Nombre</th>
            <th class="px-4 py-2 text-left border-b">Correo</th>
            <th class="px-4 py-2 text-left border-b">Rol</th>
            <th class="px-4 py-2 text-left border-b">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">{{ $user->nombre }} {{ $user->apellido }}</td>
            <td class="py-3 px-4">{{ $user->email }}</td>
            <td class="py-3 px-4">{{ $user->role }}</td>
            <td class="py-3 px-4">
                <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="text-blue-500">Editar</a>
            </td>
            <td class="py-3 px-4">
                <button onclick="openModal({{ $user->id }})" class="text-red-500 hover:text-red-700">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal de Confirmación de Eliminación -->
<div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Confirmar Eliminación</h3>
        <p class="text-gray-600 mb-4">¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg">Cancelar</button>
            <form id="delete-form" action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg">Eliminar</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal de confirmación
    function openModal(userId) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('delete-form').action = '/admin/usuarios/' + userId;
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection
