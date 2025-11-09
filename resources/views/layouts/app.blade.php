<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- === INCLUSIÓN DE FONT AWESOME PARA ICONOS (LUPA Y CARRITO) === -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/CDQ+09fC3J4Qn2z5c1cM3P92/d1E4A9i4j2n0wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- ============================================================= -->


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            <!-- La vista 'layouts.navigation' es solo para usuarios logueados. 
                 La página principal 'welcome' usa su propio encabezado.
            -->
            @auth
                @include('layouts.navigation')
            @endauth
            

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

        </div>
        
        <!-- Aquí podríamos incluir el carrito flotante si queremos que aparezca en todas las páginas, 
             pero por ahora lo dejaremos en welcome.blade.php para el diseño personalizado.
        -->
    </body>
</html>