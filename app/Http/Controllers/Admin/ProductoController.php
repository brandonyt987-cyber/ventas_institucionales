<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(10);
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
            'precio' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nombre', 'descripcion', 'precio', 'stock');

        // Guardar imagen
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado exitosamente.');
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
            'precio' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',    // ❗ No permitir stock = 0
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Actualizar datos base
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;

        // Si hay imagen nueva
        if ($request->hasFile('imagen')) {

            // Eliminar imagen anterior si existe
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            // Guardar nueva imagen
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    public function inventario()
    {
        $totalProductos = Producto::count();
        $stockTotal = Producto::sum('stock');
        $stockBajo = Producto::where('stock', '<', 10)->where('stock', '>', 0)->count();
        $sinStock = Producto::where('stock', 0)->count();

        $productos = Producto::paginate(15);

        return view('admin.inventario', compact(
            'totalProductos',
            'stockTotal',
            'stockBajo',
            'sinStock',
            'productos'
        ));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');

        $productos = Producto::where(function ($q) use ($query) {
            $q->where('nombre', 'like', "%$query%")
              ->orWhere('descripcion', 'like', "%$query%");
        })
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
