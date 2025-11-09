<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Ver el carrito
    public function index()
    {
        $items = Carrito::with('producto')
            ->where('user_id', Auth::id())
            ->get();
            
        $total = $items->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });
        
        return view('cliente.carrito', compact('items', 'total'));
    }

    // Agregar producto al carrito
    public function agregar(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        
        // Validar que haya stock
        if ($producto->stock < 1) {
            return back()->with('error', 'Producto sin stock disponible');
        }

        $cantidad = $request->input('cantidad', 1);

        // Verificar si el producto ya está en el carrito
        $itemCarrito = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $productoId)
            ->first();

        if ($itemCarrito) {
            // Si ya existe, actualizar cantidad
            $nuevaCantidad = $itemCarrito->cantidad + $cantidad;
            
            // Validar que no exceda el stock
            if ($nuevaCantidad > $producto->stock) {
                return back()->with('error', 'No hay suficiente stock disponible');
            }
            
            $itemCarrito->update(['cantidad' => $nuevaCantidad]);
            return back()->with('success', 'Cantidad actualizada en el carrito');
        } else {
            // Si no existe, crear nuevo item
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
            ]);
            
            return back()->with('success', 'Producto agregado al carrito');
        }
    }

    // Actualizar cantidad
    public function actualizar(Request $request, $itemId)
    {
        $item = Carrito::where('user_id', Auth::id())
            ->where('id', $itemId)
            ->firstOrFail();
            
        $cantidad = $request->input('cantidad', 1);
        
        // Validar stock
        if ($cantidad > $item->producto->stock) {
            return back()->with('error', 'No hay suficiente stock disponible');
        }
        
        if ($cantidad > 0) {
            $item->update(['cantidad' => $cantidad]);
            return back()->with('success', 'Cantidad actualizada');
        }
        
        return back()->with('error', 'La cantidad debe ser mayor a 0');
    }

    // Eliminar del carrito
    public function eliminar($itemId)
    {
        $item = Carrito::where('user_id', Auth::id())
            ->where('id', $itemId)
            ->firstOrFail();
            
        $item->delete();
        
        return back()->with('success', 'Producto eliminado del carrito');
    }

    // Vaciar carrito
    public function vaciar()
    {
        Carrito::where('user_id', Auth::id())->delete();
        
        return back()->with('success', 'Carrito vaciado');
    }

    // Contar items en el carrito (para el badge del navbar)
    public static function contarItems()
    {
        if (!Auth::check()) {
            return 0;
        }
        
        return Carrito::where('user_id', Auth::id())->sum('cantidad');
    }
}