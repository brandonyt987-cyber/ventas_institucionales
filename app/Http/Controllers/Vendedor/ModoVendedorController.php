<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ModoVendedorController extends Controller
{
    public function cambiarModo()
    {
          /** @var User $user */
        $user = Auth::user();

        if ($user->rol === 'vendedor') {
            $user->modo_vendedor = !$user->modo_vendedor;
            $user->save();

            // Redirige automáticamente al dashboard correspondiente
            if ($user->modo_vendedor) {
                return redirect()->route('vendedor.dashboard')
                    ->with('status', 'Modo vendedor activado correctamente.');
            } else {
                return redirect()->route('cliente.dashboard')
                    ->with('status', 'Modo cliente activado correctamente.');
            }
        }

        return redirect()->back()->with('error', 'Solo los vendedores pueden cambiar de modo.');
    }
}
