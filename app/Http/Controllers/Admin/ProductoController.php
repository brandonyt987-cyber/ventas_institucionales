<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        Producto::create($request->only('nombre', 'descripcion', 'precio', 'cantidad'));

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        $producto->update($request->only('nombre', 'descripcion', 'precio', 'cantidad'));

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

        public function inventario()
    {
        $totalProductos = Producto::count();
        $stockTotal = Producto::sum('stock');
        $stockBajo = Producto::where('stock', '>', 0)->where('stock', '<', 10)->count();
        $sinStock = Producto::where('stock', 0)->count();

        $productos = Producto::paginate(15);

        return view('admin.inventario', compact('totalProductos', 'stockTotal', 'stockBajo', 'sinStock', 'productos'));
    }

    public function buscar(Request $request)
{
    $query = $request->input('q');
    
    $productos = Producto::where('nombre', 'like', "%$query%")
                        ->orWhere('descripcion', 'like', "%$query%")
                        ->where('stock', '>', 0)
                        ->get();
    
    return view('productos.buscar', compact('productos', 'query'));
}

public function mostrar($id)
{
    $producto = Producto::findOrFail($id);
    return view('productos.mostrar', compact('producto'));
}

    
}
