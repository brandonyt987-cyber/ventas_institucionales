@extends('layouts.app')

@section('content')
<div class="container py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">🛒 Tu carrito de compras</h1>

    @if($carrito->isEmpty())
        <div class="text-center py-10">
            <p class="text-gray-500 text-lg">Tu carrito está vacío.</p>
            <a href="{{ url('/') }}" class="mt-4 inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-lg">
                Seguir comprando
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Producto</th>
                        <th class="py-3 px-4 text-center">Cantidad</th>
                        <th class="py-3 px-4 text-right">Precio</th>
                        <th class="py-3 px-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrito as $carrito)
                        <tr class="border-t">
                            <td class="py-3 px-4">{{ $carrito->producto->nombre }}</td>
                            <td class="py-3 px-4 text-center">{{ $carrito->cantidad }}</td>
                            <td class="py-3 px-4 text-right">${{ number_format($carrito->producto->precio, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right">${{ number_format($carrito->cantidad * $carrito->producto->precio, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right mt-6">
            <h2 class="text-xl font-semibold">Total: ${{ number_format($total, 0, ',', '.') }}</h2>
        </div>

        <div class="flex justify-end mt-8 space-x-4">
            <a href="{{ url('/') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-3 rounded-lg">
                Seguir comprando
            </a>
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-5 py-3 rounded-lg">
                Proceder al pago
            </button>
        </div>
    @endif
</div>
@endsection
