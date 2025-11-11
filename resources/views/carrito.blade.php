@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-2xl font-bold mb-4">🛒 Tu carrito</h1>

    @if($items->isEmpty())
        <p>No hay productos en tu carrito.</p>
    @else
        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Producto</th>
                    <th class="px-4 py-2 text-left">Cantidad</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->producto->nombre }}</td>
                        <td class="px-4 py-2">{{ $item->cantidad }}</td>
                        <td class="px-4 py-2">${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">${{ number_format($item->cantidad * $item->producto->precio, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-6">
            <h3 class="text-xl font-semibold">Total: ${{ number_format($total, 0, ',', '.') }}</h3>
        </div>
    @endif
</div>
@endsection
