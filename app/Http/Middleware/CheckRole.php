<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado y tiene el rol adecuado
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Si no está autenticado o no tiene el rol adecuado, redirige
        return redirect()->route('login');
    }
}
