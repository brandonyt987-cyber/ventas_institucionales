<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener los productos (puedes limitar a 4 o más)
        $productos = Producto::take(4)->get();

        // Enviar a la vista
        return view('welcome', compact('productos'));
    }
}
