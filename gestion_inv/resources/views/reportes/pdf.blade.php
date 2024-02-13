<!-- resources/views/reporte/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Reporte PDF</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte</h1>

    @if ($tipoReporte === 'ventas' && isset($datos['ventas']) && count($datos['ventas']) > 0)
<p>Se realizaron un total de {{ $total }} {{ $tipoReporte }} en el rango de fechas proporcionado.</p>
        <p>Cantidad de Ventas: {{ $cantidadVentas }}</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <!-- Agrega más columnas según los campos de tu modelo de ventas -->
                </tr>
            </thead>
            <tbody>
                @foreach ($datos['ventas'] as $venta)
                    <tr>
                        <td>{{ $venta->venta_id }}</td>
                        <td>{{ $venta->venta_fecha }}</td>
                        <!-- Agrega más columnas según los campos de tu modelo de ventas -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($tipoReporte === 'compras' && isset($datos['compras']) && count($datos['compras']) > 0)
        <h2>Compras</h2>
<p>Se realizaron un total de {{ $total }} {{ $tipoReporte }} en el rango de fechas proporcionado.</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Factura</th>
                    <!-- Agrega más columnas según los campos de tu modelo de compras -->
                </tr>
            </thead>
            <tbody>
                @foreach ($datos['compras'] as $compra)
                    <tr>
                        <td>{{ $compra->compra_id }}</td>
                        <td>{{ $compra->compra_fecha }}</td>
                        <td>{{ $compra->compra_factura }}</td>
                        <!-- Agrega más columnas según los campos de tu modelo de compras -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No se encontraron datos para el tipo de reporte seleccionado.</p>
    @endif
</body>
</html>
