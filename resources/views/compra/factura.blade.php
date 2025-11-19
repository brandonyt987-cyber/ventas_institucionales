@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6">Factura</h1>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}</p>
                <p><strong>Email:</strong> {{ $pedido->cliente->email }}</p>
            </div>
            <div class="text-right">
                <p><strong>Factura:</strong> {{ $pedido->numero_factura }}</p>
                <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <table class="w-full border-collapse mb-8">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2 text-left">Producto</th>
                    <th class="border p-2 text-right">Precio</th>
                    <th class="border p-2 text-right">Cantidad</th>
                    <th class="border p-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->items_json as $item)
                <tr>
                    <td class="border p-2">{{ $item['nombre'] }}</td>
                    <td class="border p-2 text-right">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                    <td class="border p-2 text-right">{{ $item['cantidad'] }}</td>
                    <td class="border p-2 text-right">${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mb-8">
            <p class="text-2xl font-bold">Total: ${{ number_format($pedido->total, 0, ',', '.') }}</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('compra.pdf', $pedido->id) }}" class="bg-blue-600 text-white px-6 py-2 rounded">
                📥 Descargar PDF
            </a>
            <a href="{{ route('inicio') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection