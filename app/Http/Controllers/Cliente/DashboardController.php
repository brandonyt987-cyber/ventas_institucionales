<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        
        if ($user->modo_vendedor) {
            return redirect()->route('vendedor.dashboard');
        }

        $productos = Producto::where('stock', '>', 0)->get();
        return view('cliente.dashboard', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('cliente.producto-detalle', compact('producto'));
    }

    public function cambiarModo(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->modo_vendedor = !$user->modo_vendedor;
        $user->save();

        if ($user->modo_vendedor) {
            return redirect()->route('vendedor.dashboard')
                ->with('success', 'Modo vendedor activado correctamente');
        }

        return redirect()->route('cliente.dashboard')
            ->with('success', 'Modo cliente activado correctamente');
    }
}