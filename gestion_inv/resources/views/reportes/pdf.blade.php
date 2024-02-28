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
@if (count($datos['ventas']) > 0)
<p> Cliente: {{ $datos['ventas'][0]->cliente->cli_nombre }} {{ $datos['ventas'][0]->cliente->cli_apellido }}</p>
@endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGeneral = 0; // Inicializamos el total general en 0
                @endphp
                @foreach ($datos['ventas'] as $venta)
                    @php
                        $totalVenta = 0; // Inicializamos el total de la venta en 0
                    @endphp
                    @foreach ($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $venta->venta_id }}</td>
                            <td>{{ $venta->venta_fecha }}</td>
                            <td>{{ $detalle->producto->prod_nombre }}</td>
                            <td>{{ $detalle->dventa_cantidad }}</td>
                            <td>{{ $detalle->dventa_precio }}</td>
                        </tr>
                        @php
                            $totalVenta += $detalle->dventa_precio; // Sumamos el precio de venta al total de la venta
                        @endphp
                    @endforeach
                    @php
                        $totalGeneral += $totalVenta; // Sumamos el total de la venta al total general
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total General:</td>
                    <td>{{ $totalGeneral }}</td>
                </tr>
            </tfoot>
            
            
        </table>
    @elseif ($tipoReporte === 'compras' && isset($datos['compras']) && count($datos['compras']) > 0)
        <h2>Compras</h2>
<p>Se realizaron un total de {{ $total }} {{ $tipoReporte }} en el rango de fechas proporcionado.</p>
@if (count($datos['compras']) > 0)
<p> Proveedor: {{ $datos['compras'][0]->proveedor->prove_nombre }} {{ $datos['compras'][0]->proveedor->prove_apellido }}</p>
@endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Factura</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Compra</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGeneral = 0; // Inicializamos el total general en 0
                @endphp
                @foreach ($datos['compras'] as $compra)
                    @php
                        $totalCompra = 0; 
                    @endphp
                    @foreach ($compra->detalles as $detalle)
                        <tr>
                            <td>{{ $compra->compra_id }}</td>
                            <td>{{ $compra->compra_fecha }}</td>
                            <td>{{ $compra->compra_factura }}</td>
                            <td>{{ $detalle->producto->prod_nombre }}</td>
                            <td>{{ $detalle->dcompra_cantidad }}</td>
                            <td>{{ $detalle->dcompra_precio }}</td>
                        </tr>
                        @php
                            $totalCompra += $detalle->dcompra_precio; // Sumamos el precio de venta al total de la venta
                        @endphp
                    @endforeach
                    @php
                        $totalGeneral += $totalCompra; // Sumamos el total de la venta al total general
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Total General:</td>
                    <td>{{ $totalGeneral }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>No se encontraron datos para el tipo de reporte seleccionado.</p>
    @endif
</body>
</html>
