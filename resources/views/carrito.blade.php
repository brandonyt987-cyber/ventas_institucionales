@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">🛒 Tu Carrito</h1>

    @if($items->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">No hay productos en tu carrito.</p>
            <a href="{{ route('inicio') }}" class="bg-blue-600 text-white px-6 py-2 rounded inline-block hover:bg-blue-700">
                Continuar comprando
            </a>
        </div>
    @else
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Producto</th>
                        <th class="px-6 py-4 text-right font-semibold">Precio</th>
                        <th class="px-6 py-4 text-center font-semibold">Cantidad</th>
                        <th class="px-6 py-4 text-right font-semibold">Subtotal</th>
                        <th class="px-6 py-4 text-center font-semibold">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold">{{ $item->producto->nombre }}</p>
                                    <p class="text-sm text-gray-500">Vendedor: {{ $item->producto->vendedor->nombre }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                            
                            <!-- Cantidad editable -->
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->stock }}" class="w-16 px-2 py-1 border rounded text-center">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">✓</button>
                                </form>
                            </td>
                            
                            <td class="px-6 py-4 text-right font-semibold">${{ number_format($item->cantidad * $item->producto->precio, 0, ',', '.') }}</td>
                            
                            <!-- Eliminar -->
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('¿Eliminar este producto?')">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Resumen -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <span class="text-lg font-semibold">Total:</span>
                <span class="text-4xl font-bold text-green-600">${{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <!-- Botones -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('inicio') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center transition">
                    ← Continuar comprando
                </a>

                <form action="{{ route('compra.procesar') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        ✓ Procesar Compra
                    </button>
                </form>

                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition" 
                        onclick="return confirm('¿Vaciar todo el carrito?')">
                        🗑️ Vaciar Carrito
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection