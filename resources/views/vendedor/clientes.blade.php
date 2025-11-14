@extends('layouts.vendedor')

@section('title', 'Mis Clientes')

@section('content')
<div>
    <!-- Encabezado -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Mis Clientes</h2>
        <p class="text-gray-600">Gestiona y visualiza tus clientes</p>
    </div>

    <!-- Tabla de Clientes -->
    @if($clientes->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Teléfono</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Registrado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $cliente->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $cliente->email }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $cliente->phone ?? 'No registrado' }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $cliente->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $clientes->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay clientes registrados</h3>
            <p class="text-gray-500">Pronto tendrás clientes en tu lista</p>
        </div>
    @endif
</div>
@endsection
