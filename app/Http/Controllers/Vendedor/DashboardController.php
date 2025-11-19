<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */ $user = auth()->user();
        if ($user->role === 'cliente' && !$user->modo_vendedor) {
            return redirect()->route('cliente.dashboard');
        }
        if ($user->role !== 'cliente' && $user->role !== 'vendedor') {
            abort(403, 'No autorizado');
        }
        $productos = Producto::all();
        $totalProductos = $productos->count();
        return view('vendedor.dashboard', compact('totalProductos', 'productos'));
    }
    public function cambiarModo(Request $request)
    {
        /** @var User $user */ $user = auth()->user();
        if ($user->role !== 'cliente' && $user->role !== 'vendedor') {
            return back()->with('error', 'No tienes permiso para cambiar de modo.');
        }
        $user->modo_vendedor = !$user->modo_vendedor;
        $user->save();
        if ($user->modo_vendedor) {
            return redirect()->route('vendedor.dashboard')->with('success', 'Modo vendedor activado correctamente');
        }
        return redirect()->route('cliente.dashboard')->with('success', 'Modo cliente activado correctamente');
    }
}
