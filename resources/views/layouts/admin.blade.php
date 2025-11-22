<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    
    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome para iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Estilos adicionales --}}
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-purple-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold">Panel de Administración</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <span>Hola, <strong>{{ auth()->user()->nombre }}</strong></span>
                <span class="bg-purple-800 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-user-shield mr-1"></i> Administrador
                </span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar y Contenido -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-lg">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                        class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg transition-colors">
                            <i class="fas fa-home w-5"></i>
                            <span class="font-semibold">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.usuarios.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.usuarios.*') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg transition-colors">
                            <i class="fas fa-users w-5"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.productos.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.productos.*') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg transition-colors">
                            <i class="fas fa-box w-5"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.inventario') }}" 
                        class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('admin.inventario') ? 'bg-purple-100 text-purple-700 border-l-4 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg transition-colors">
                            <i class="fas fa-warehouse w-5"></i>
                            <span>Inventario</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-8">
            {{-- SECCIÓN DE NOTIFICACIONES GLOBALES --}}
            <div class="mb-4">
                {{-- Mensaje de éxito --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-3 rounded shadow-md alert-dismissible" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-500"></i>
                            <div class="flex-1">
                                <p class="font-semibold">¡Éxito!</p>
                                <p>{{ session('success') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-green-500 hover:text-green-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Mensaje de error --}}
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-3 rounded shadow-md alert-dismissible" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                            <div class="flex-1">
                                <p class="font-semibold">¡Error!</p>
                                <p>{{ session('error') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-red-500 hover:text-red-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Mensaje de advertencia --}}
                @if (session('warning'))
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-3 rounded shadow-md alert-dismissible" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-3 text-yellow-500"></i>
                            <div class="flex-1">
                                <p class="font-semibold">Advertencia</p>
                                <p>{{ session('warning') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-yellow-500 hover:text-yellow-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Mensaje informativo --}}
                @if (session('info'))
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-3 rounded shadow-md alert-dismissible" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-3 text-blue-500"></i>
                            <div class="flex-1">
                                <p class="font-semibold">Información</p>
                                <p>{{ session('info') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-blue-500 hover:text-blue-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-3 rounded shadow-md alert-dismissible" role="alert">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                            <div class="flex-1">
                                <p class="font-semibold mb-2">Por favor, corrija los siguientes errores:</p>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-red-500 hover:text-red-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Contenido de la página --}}
            @yield('content')
        </main>
    </div>

    {{-- Scripts globales --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminacionSweet(event, nombre) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Eliminar permanentemente?',
            html: `<span class="text-lg">Vas a eliminar al usuario:</span><br><strong class="text-xl text-red-600">${nombre}</strong><br><br>Esta acción <strong>NO se puede deshacer</strong>.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash-alt mr-2"></i>Sí, eliminar permanentemente',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Cancelar',
            reverseButtons: true,
            padding: '2rem',
            backdrop: `rgba(0,0,0,0.9)`,
            customClass: {
                popup: 'border-l-4 border-red-600',
                title: 'text-2xl font-bold',
                confirmButton: 'px-6 py-3 text-lg',
                cancelButton: 'px-6 py-3 text-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Animación antes de enviar
                Swal.fire({
                    title: 'Eliminando...',
                    icon: 'info',
                    timer: 1500,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willClose: () => {
                        form.submit();
                    }
                });
            }
        });
    }
</script>

    {{-- Estilos para animaciones --}}
    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .alert-dismissible {
            position: relative;
            animation: slideInRight 0.5s ease-out;
        }
    </style>

    {{-- SweetAlert2 (Opcional pero recomendado) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función de confirmación elegante con SweetAlert2
        function confirmarEliminacionSweet(event, nombreProducto) {
            event.preventDefault();
            const form = event.target.closest('form');
            
            Swal.fire({
                title: '¿Eliminar producto?',
                text: `¿Está seguro que desea eliminar "${nombreProducto}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }

        // Mostrar notificación con SweetAlert2 si existe un mensaje de sesión
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        @endif
    </script>

    {{-- Scripts adicionales de páginas específicas --}}
    @stack('scripts')
</body>
</html>