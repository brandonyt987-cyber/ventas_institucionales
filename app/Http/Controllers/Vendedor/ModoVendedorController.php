<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModoVendedorController extends Controller
{
    public function toggle()
    {
        $user = Auth::user();

        // Si el usuario NO tiene el modo vendedor activado, lo activamos
        $nuevoEstado = !$user->modo_vendedor;

        // Guardar en BD
        $user->modo_vendedor = $nuevoEstado;
        $user->save();

        // Guardar en sesión
        session(['modo_vendedor' => $nuevoEstado]);

        // Redirigir según el modo
        if ($nuevoEstado) {
            return redirect()->route('vendedor.dashboard')
                ->with('success', 'Modo vendedor activado.');
        } else {
            return redirect()->route('cliente.dashboard')
                ->with('success', 'Modo vendedor desactivado.');
        }
    }
}
