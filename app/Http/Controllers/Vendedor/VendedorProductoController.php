<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('user_id', Auth::id())->get();
        return view('vendedor.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('vendedor.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $imagenPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('vendedor.productos.index')->with('success', 'Producto creado con éxito');
    }
}
