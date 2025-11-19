<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        $query = Producto::orderBy('created_at', 'desc');

        // Si el usuario está logueado, NO mostrar sus propios productos
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        // Obtener productos (6 más recientes)
        $productos = $query->limit(6)->get();

        return view('welcome', compact('productos'));
    }
}
