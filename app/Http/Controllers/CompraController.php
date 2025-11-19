<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function procesarCompra(Request $request)
    {
        $user = auth()->user();
        $items = Carrito::where('user_id', $user->id)->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'El carrito está vacío');
        }

        $total = 0;
        $itemsData = [];

        foreach ($items as $item) {
            $producto = $item->producto;

            // EVITAR que compre su propio producto
            if ($producto->user_id == $user->id) {
                return back()->with('error', 'No puedes comprar tu propio producto.');
            }

            $subtotal = $producto->precio * $item->cantidad;
            $total += $subtotal;

            $itemsData[] = [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $item->cantidad,
                'subtotal' => $subtotal,
            ];

            // Reducir stock
            $producto->stock -= $item->cantidad;
            $producto->save();
        }

        $numeroFactura = 'FAC-' . date('YmdHis') . '-' . $user->id;

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'vendedor_id' => $items[0]->producto->user_id,
            'total' => $total,
            'estado' => 'pagado',
            'items_json' => $itemsData,
            'numero_factura' => $numeroFactura,
        ]);

        // Limpiar carrito
        Carrito::where('user_id', $user->id)->delete();

        return redirect()
            ->route('compra.factura', $pedido->id)
            ->with('success', 'Compra realizada correctamente');
    }

    public function factura($id)
    {
        $pedido = Pedido::findOrFail($id);

        if (auth()->id() !== $pedido->user_id && auth()->id() !== $pedido->vendedor_id) {
            abort(403);
        }

        return view('compra.factura', compact('pedido'));
    }

    public function descargarPDF($id)
    {
        $pedido = Pedido::findOrFail($id);

        if (auth()->id() !== $pedido->user_id && auth()->id() !== $pedido->vendedor_id) {
            abort(403);
        }

        $pdf = Pdf::loadView('compra.factura-pdf', compact('pedido'));
        return $pdf->download('factura-' . $pedido->numero_factura . '.pdf');
    }
}
