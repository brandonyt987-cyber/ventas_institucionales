@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Gestión de Usuarios</h2>
    <p class="text-gray-600">Administrar cuentas de clientes, vendedores y administradores</p>
</div>

<!-- Tarjetas rápidas -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    
    <!-- Total Usuarios -->
    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-indigo-100 text-sm font-medium opacity-90">Total Usuarios</p>
                <h3 class="text-5xl font-bold mt-3">{{ \App\Models\User::count() }}</h3>
            </div>
            <i class="fas fa-users text-6xl opacity-30"></i>
        </div>
    </div>

    <!-- Clientes -->
    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium opacity-90">Clientes</p>
                <h3 class="text-5xl font-bold mt-3">{{ \App\Models\User::where('role', 'cliente')->count() }}</h3>
            </div>
            <i class="fas fa-user text-6xl opacity-30"></i>
        </div>
    </div>

    <!-- Clientes con Modo Vendedor Activo -->
    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-100 text-sm font-medium opacity-90">Modo Vendedor Activo</p>
                <h3 class="text-5xl font-bold mt-3">
                    {{ \App\Models\User::where('role', 'cliente')->where('modo_vendedor', true)->count() }}
                </h3>
                <p class="text-xs mt-2 opacity-80">clientes vendiendo ahora</p>
            </div>
            <i class="fas fa-store-alt text-6xl opacity-30"></i>
        </div>
        @if(\App\Models\User::where('role', 'cliente')->where('modo_vendedor', true)->count() > 0)
            <div class="absolute top-3 right-3 animate-pulse">
                <span class="relative flex h-5 w-5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-5 w-5 bg-emerald-500"></span>
                </span>
            </div>
        @endif
    </div>
</div>

<!-- Tabla de usuarios -->
<div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
    <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold flex items-center">
                <i class="fas fa-list mr-3"></i> Todos los Usuarios
            </h3>
            <span class="text-indigo-100">{{ \App\Models\User::count() }} registrados</span>
        </div>
    </div>

    @if($usuarios->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Usuario</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Rol</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Modo Vendedor</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Registrado</th>
                        <th class="px-8 py-5 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($usuarios as $usuario)
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-200 group">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br 
                                    {{ $usuario->role === 'admin' ? 'from-purple-500 to-pink-500' : '' }}
                                    {{ $usuario->role === 'vendedor' ? 'from-yellow-500 to-orange-500' : '' }}
                                    {{ $usuario->role === 'cliente' ? 'from-blue-500 to-cyan-500' : '' }}
                                    text-white font-bold flex items-center justify-center text-lg shadow-lg mr-4">
                                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-lg group-hover:text-indigo-600 transition">
                                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                                    </p>
                                    @if($usuario->username)
                                        <p class="text-sm text-gray-500">@{{ $usuario->username }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-gray-700 font-medium">{{ $usuario->email }}</td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-2 rounded-full text-xs font-bold
                                {{ $usuario->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $usuario->role === 'vendedor' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $usuario->role === 'cliente' ? 'bg-blue-100 text-blue-800' : '' }}">
                                <i class="fas {{ $usuario->role === 'admin' ? 'fa-user-shield' : ($usuario->role === 'vendedor' ? 'fa-store' : 'fa-user') }} mr-2"></i>
                                {{ ucfirst($usuario->role) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($usuario->role === 'cliente')
                                @if($usuario->modo_vendedor)
                                    <span class="px-5 py-2 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 animate-pulse shadow-md">
                                        <i class="fas fa-check-circle mr-1"></i> ACTIVO
                                    </span>
                                @else
                                    <span class="px-5 py-2 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400 text-sm italic">No aplica</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-sm text-gray-600">
                            {{ $usuario->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                   class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition shadow-lg"
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if($usuario->id !== auth()->id())
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="confirmarEliminacionSweet(event, '{{ $usuario->nombre }} {{ $usuario->apellido }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-gradient-to-r from-red-500 to-rose-600 text-white p-3 rounded-xl hover:from-red-600 hover:to-rose-700 transition shadow-lg"
                                            title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 bg-gray-50 border-t-2 border-gray-200">
            {{ $usuarios->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-20">
            <i class="fas fa-users-slash text-9xl text-gray-200 mb-6"></i>
            <p class="text-gray-500 text-xl">No hay usuarios registrados aún</p>
        </div>
    @endif
</div>
@endsection