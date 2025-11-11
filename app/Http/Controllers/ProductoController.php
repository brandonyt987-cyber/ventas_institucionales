<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function buscar(Request $request)
    {
        if (auth()->check()) {
        $user = auth()->user();
        }
        $query = $request->input('q');

        // Buscar por nombre o descripción
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        return view('pages.resultados', compact('productos', 'query'));
    }

    public function mostrar($id)        
    {
    $producto = Producto::findOrFail($id);
    return view('producto.mostrar', compact('producto'));
    }
}