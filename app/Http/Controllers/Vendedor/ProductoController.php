<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Producto::where('user_id', $userId);

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                  ->orWhere('descripcion', 'like', "%$buscar%");
            });
        }

        $orden = $request->input('orden', 'created_at');
        $direccion = $request->input('direccion', 'desc');

        $productos = $query->orderBy($orden, $direccion)->paginate(10);

        return view('vendedor.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('vendedor.productos.create');
    }

    public function store(Request $request)
    {
        // 🔵 1. Limpiar precio COP → número entero
        $precioLimpio = preg_replace('/\D/', '', $request->precio);
        $request->merge(['precio' => $precioLimpio]);

        // 🔵 2. Validación
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 🔵 3. Imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('productos', $nombreImagen, 'public');
            $validated['imagen'] = 'productos/' . $nombreImagen;
        }

        // 🔵 4. Asociar producto al vendedor
        $validated['user_id'] = auth()->id();

        Producto::create($validated);

        return redirect()->route('vendedor.productos.index')
                         ->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::where('user_id', auth()->id())->findOrFail($id);

        return view('vendedor.productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::where('user_id', auth()->id())->findOrFail($id);

        // 🔵 Limpiar precio COP
        $precioLimpio = preg_replace('/\D/', '', $request->precio);
        $request->merge(['precio' => $precioLimpio]);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(storage_path('app/public/' . $producto->imagen))) {
                unlink(storage_path('app/public/' . $producto->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->storeAs('productos', $nombreImagen, 'public');
            $validated['imagen'] = 'productos/' . $nombreImagen;
        }

        $producto->update($validated);

        return redirect()->route('vendedor.productos.index')
                         ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::where('user_id', auth()->id())->findOrFail($id);

        if ($producto->imagen && file_exists(storage_path('app/public/' . $producto->imagen))) {
            unlink(storage_path('app/public/' . $producto->imagen));
        }

        $producto->delete();

        return redirect()->route('vendedor.productos.index')
                         ->with('success', 'Producto eliminado correctamente');
    }
}
