<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $pedido->numero_factura }}</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .info { display: flex; justify-content: space-between; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f5f5f5; }
        .total { text-align: right; font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURA</h1>
        <p>{{ $pedido->numero_factura }}</p>
    </div>

    <div class="info">
        <div>
            <p><strong>Cliente:</strong></p>
            <p>{{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}</p>
            <p>{{ $pedido->cliente->email }}</p>
        </div>
        <div style="text-align: right;">
            <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->items_json as $item)
            <tr>
                <td>{{ $item['nombre'] }}</td>
                <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                <td>{{ $item['cantidad'] }}</td>
                <td>${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: ${{ number_format($pedido->total, 0, ',', '.') }}
    </div>
</body>
</html>