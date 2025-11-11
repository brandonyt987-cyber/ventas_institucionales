<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $carrito = Carrito::where('user_id', Auth::id())->with('producto')->get();
        $total = $carrito->sum(fn($item) => $item->producto->precio * $item->cantidad);

        return view('cliente.carrito', compact('carrito', 'total'));
    }

    // Agregar producto al carrito
    public function agregar(Request $request, $productoId)
    {
        // Si no está logueado, guardamos el intento y redirigimos al login
        if (!Auth::check()) {
            Session::put('producto_pendiente', $productoId);
            return redirect()->route('login')->with('info', 'Inicia sesión para agregar productos al carrito.');
        }

        $producto = Producto::findOrFail($productoId);

        if ($producto->stock < 1) {
            return back()->with('error', 'Producto sin stock disponible.');
        }

        $cantidad = $request->input('cantidad', 1);

        $itemCarrito = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $productoId)
            ->first();

        if ($itemCarrito) {
            $nuevaCantidad = $itemCarrito->cantidad + $cantidad;

            if ($nuevaCantidad > $producto->stock) {
                return back()->with('error', 'No hay suficiente stock disponible.');
            }

            $itemCarrito->update(['cantidad' => $nuevaCantidad]);
            return back()->with('success', 'Cantidad actualizada en el carrito.');
        } else {
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
            ]);

            return back()->with('success', 'Producto agregado al carrito.');
        }
    }

    // Actualizar cantidad de producto
    public function actualizar(Request $request, $itemId)
    {
        $item = Carrito::findOrFail($itemId);
        $cantidad = $request->input('cantidad');

        if ($cantidad < 1) {
            return back()->with('error', 'La cantidad debe ser al menos 1.');
        }

        if ($cantidad > $item->producto->stock) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $item->update(['cantidad' => $cantidad]);
        return back()->with('success', 'Cantidad actualizada.');
    }

    // Eliminar un producto del carrito
    public function eliminar($itemId)
    {
        $item = Carrito::findOrFail($itemId);
        $item->delete();
        return back()->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar carrito
    public function vaciar()
    {
        Carrito::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Carrito vaciado correctamente.');
    }

    // ✅ Método para contar productos en el carrito (para el icono del navbar)
    public static function contarItems()
    {
        if (!Auth::check()) {
            return 0;
        }

        return Carrito::where('user_id', Auth::id())->sum('cantidad');
    }
}
