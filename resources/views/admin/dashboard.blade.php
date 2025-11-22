@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-10">
    <h2 class="text-4xl font-bold text-gray-800 mb-3">
        Bienvenido, {{ auth()->user()->nombre }}
    </h2>
</div>

<!-- 3 Tarjetas grandes y hermosas -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    
    <!-- Total Usuarios -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 border-t-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-lg font-medium">Total Usuarios</p>
                <h3 class="text-5xl font-bold text-gray-800 mt-3">{{ \App\Models\User::count() }}</h3>
            </div>
            <div class="bg-blue-100 p-6 rounded-2xl">
                <i class="fas fa-users text-5xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Total Productos -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 border-t-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-lg font-medium">Productos Registrados</p>
                <h3 class="text-5xl font-bold text-gray-800 mt-3">{{ \App\Models\Producto::count() }}</h3>
            </div>
            <div class="bg-green-100 p-6 rounded-2xl">
                <i class="fas fa-boxes text-5xl text-green-600"></i>
            </div>
        </div>
    </div>

    <!-- Stock Total -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 border-t-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-lg font-medium">Stock Total</p>
                <h3 class="text-5xl font-bold text-gray-800 mt-3">{{ \App\Models\Producto::sum('stock') }}</h3>
                <p class="text-sm text-gray-500 mt-2">unidades en inventario</p>
            </div>
            <div class="bg-purple-100 p-6 rounded-2xl">
                <i class="fas fa-warehouse text-5xl text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Usuarios recientes (solo lo esencial y hermoso) -->
<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
        <h3 class="text-2xl font-bold flex items-center">
            <i class="fas fa-user-clock mr-3 text-xl"></i>
            Últimos Usuarios Registrados
        </h3>
    </div>
    
    <div class="p-8">
        @if(\App\Models\User::latest()->take(6)->exists())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach(\App\Models\User::latest()->take(6)->get() as $user)
                <div class="flex items-center space-x-5 p-5 rounded-2xl hover:bg-gray-50 transition-all group">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        {{ strtoupper(substr($user->nombre, 0, 1)) }}
                    </div>
                    
                    <div class="flex-1">
                        <p class="font-bold text-gray-800 text-lg group-hover:text-indigo-600 transition">
                            {{ $user->nombre }} {{ $user->apellido }}
                        </p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $user->created_at->format('d/m') }}</p>
                        <span class="inline-block px-4 py-2 rounded-full text-xs font-bold mt-2
                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $user->role === 'vendedor' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $user->role === 'cliente' ? 'bg-blue-100 text-blue-700' : '' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-users text-8xl text-gray-200 mb-6"></i>
                <p class="text-gray-500 text-xl">Aún no hay usuarios registrados</p>
            </div>
        @endif
    </div>
</div>
@endsection