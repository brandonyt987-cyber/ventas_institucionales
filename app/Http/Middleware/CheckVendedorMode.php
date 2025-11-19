<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVendedorMode
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Si no hay usuario autenticado
        if (!$user) {
            return redirect()->route('login');
        }

        // Solo clientes pueden activar modo vendedor
        if ($user->role !== 'cliente') {
            return redirect()->route('dashboard')->with('error', 'Solo los clientes pueden usar modo vendedor.');
        }

        // Cliente sin modo activado NO puede entrar a rutas vendedor
        if ($user->modo_vendedor != 1) {
            return redirect()->route('cliente.dashboard')
                ->with('error', 'Activa el modo vendedor para acceder.');
        }

        return $next($request);
    }
}
