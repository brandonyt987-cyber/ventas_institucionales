<nav class="bg-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center text-white">
        <div class="text-xl font-semibold">
            Ventas Institucionales
        </div>

        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:text-gray-300">Inicio</a></li>

            @auth
                @if(Auth::user()->rol === 'cliente')
                    <li><a href="{{ route('cliente.dashboard') }}" class="hover:text-gray-300">Dashboard Cliente</a></li>
                @elseif(Auth::user()->rol === 'vendedor')
                    <li><a href="{{ route('vendedor.dashboard') }}" class="hover:text-gray-300">Dashboard Vendedor</a></li>
                @elseif(Auth::user()->rol === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Panel Admin</a></li>
                @endif

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-red-400">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-gray-300">Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-gray-300">Registrarse</a></li>
            @endauth
                
        @if(Auth::check() && Auth::user()->rol === 'vendedor')
    <span class="ml-2 px-3 py-1 rounded-full text-sm font-bold 
        {{ Auth::user()->modo_vendedor ? 'bg-blue-600' : 'bg-gray-500' }}">
        {{ Auth::user()->modo_vendedor ? 'VENDEDOR' : 'CLIENTE' }}
    </span>
@endif



           @if(Auth::check() && Auth::user()->rol === 'vendedor')
    <form action="{{ route('vendedor.cambiarModo') }}" method="POST" class="inline">
        @csrf
        <button type="submit"
            class="ml-3 px-4 py-2 rounded-lg font-semibold transition 
            {{ Auth::user()->modo_vendedor ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
            {{ Auth::user()->modo_vendedor ? 'Cambiar a modo Cliente' : 'Cambiar a modo Vendedor' }}
        </button>
    </form>
@endif

        @endif

        </ul>
    </div>
</nav>
