<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
    
        $productos = Producto::where('stock', '>', 0)->get();
        return view('cliente.dashboard', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('cliente.producto-detalle', compact('producto'));
    }
}