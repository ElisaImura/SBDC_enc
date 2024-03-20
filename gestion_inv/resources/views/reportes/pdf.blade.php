<!-- resources/views/reporte/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Stocking - Reporte de
        @if ($tipoReporte === 'ventas')
            Ventas
        @elseif($tipoReporte === 'compras')
            Compras
        @else
            Stock
        @endif
     - PDF</title>
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
            border: 1px solid black !important;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #D80E15 !important;
            color: white !important;
        }
        .line {
            border-top: 1px solid #1B2E51;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .details {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        .details th, .details td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        h1{
            color: #1B2E51;
        }
    </style>
</head>
<body>
    <h1>Reporte de
        @if ($tipoReporte === 'ventas')
            Ventas
        @elseif($tipoReporte === 'compras')
            Compras
        @else
            Stock
        @endif
    </h1>

    <!-- PARTE DE VENTAS -->
    @if ($tipoReporte === 'ventas' && isset($datos['ventas']) && count($datos['ventas']) > 0)
        @if ($todo === false)
            <p>Se realizaron un total de {{ $total }} {{ $tipoReporte }} entre el {{ $fechaInicio }} y el {{ $fechaFin }}.</p>
        @else
            <p>Se realizaron un total de {{ $total }} {{ $tipoReporte }}.</p>
        @endif
        @foreach ($datos['ventas'] as $venta)
            @php
                $totalGeneral = 0;
            @endphp
            <div>
                <p><strong>Cliente:</strong> {{ $venta->cliente->cli_nombre }} {{ $venta->cliente->cli_apellido }} <span style="float:right;"><strong>Fecha:</strong> {{ $venta->venta_fecha }}</span></p>
            </div>
            <table class="details">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->prod_nombre }}</td>
                            <td>{{ $detalle->dventa_cantidad }}</td>
                            <td>{{ $detalle->dventa_precio }}</td>
                            <td>{{ ($detalle->dventa_precio)*($detalle->dventa_cantidad) }}</td>
                        </tr>
                        @php
                            $totalGeneral += ($detalle->dventa_precio * $detalle->dventa_cantidad);
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <p><span style="float:right;"><strong>Total General:</strong> {{ $totalGeneral }}</span></p>
            <div class="line"></div>
        @endforeach

    <!-- PARTE DE COMPRAS -->
    @elseif ($tipoReporte === 'compras' && isset($datos['compras']) && count($datos['compras']) > 0)
        @if ($todo === false)
            <p>Se realizaron un total de {{ $total }} {{ $tipoReporte }} entre el {{ $fechaInicio }} y el {{ $fechaFin }}.</p>
        @else
            <p>Se realizaron un total de {{ $total }} {{ $tipoReporte }}.</p>
        @endif
        @foreach ($datos['compras'] as $compra)
            @php
                $totalGeneral = 0;
            @endphp
            <div>
                <p><strong>Proveedor:</strong> {{ $compra->proveedor->prove_nombre }} <span style="float:right;"><strong>Fecha:</strong> {{ $compra->compra_fecha }}</span></p>
                <p><strong>Factura:</strong> {{ $compra->compra_factura }}</p>
            </div>
            <table class="details">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio de costo</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compra->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->prod_nombre }}</td>
                            <td>{{ $detalle->dcompra_cantidad }}</td>
                            <td>{{ $detalle->dcompra_precio }}</td>
                            <td>{{ ($detalle->dcompra_precio)*($detalle->dcompra_cantidad) }}</td>
                        </tr>
                        @php
                            $totalGeneral += ($detalle->dcompra_precio * $detalle->dcompra_cantidad);
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <p><span style="float:right;"><strong>Total General:</strong> {{ $totalGeneral }}</span></p>
            <div class="line"></div>
        @endforeach

    <!-- PARTE DE STOCK -->
    @elseif ($tipoReporte === 'stock' && isset($datos['stock']) && count($datos['stock']) > 0)
        <p>Existen un total de {{ $total }} productos.</p>
        @php
            $totalGeneral = 0;
            $contador = 1;
        @endphp
        <h3>Productos sin stock disponible</h3>
        <table class="details">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Stock disponible</th>
                    <th>Precio de venta</th>
                    <th>Precio de compra</th>
                    <th>Total Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos['stock'] as $producto)
                    @if ($producto->prod_cant == 0)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $producto->prod_nombre }}</td>
                            <td>{{ $producto->categoria->cat_nombre}}</td>
                            <td>{{ $producto->prod_descripcion}}</td>
                            <td>{{ $producto->prod_cant }}</td>
                            <td>{{ $producto->prod_precioventa }}</td>
                            <td>{{ $producto->prod_preciocosto }}</td>
                            <td>{{ ($producto->prod_precioventa)*($producto->prod_cant) }}</td>
                        </tr>
                        @php
                            $totalGeneral += ($producto->prod_precioventa * $producto->prod_cant);
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
        <p><span style="float:right;"><strong>Total General:</strong> {{ $totalGeneral }}</span></p>

        @php
            $totalGeneral = 0;
            $contador = 1;
        @endphp
        <h3>Productos con stock crítico</h3>
        <table class="details">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Stock disponible</th>
                    <th>Precio de venta</th>
                    <th>Precio de compra</th>
                    <th>Total Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos['stock'] as $producto)
                    @if (($producto->prod_cant < $stock_min) && ($producto->prod_cant!=0))
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $producto->prod_nombre }}</td>
                            <td>{{ $producto->categoria->cat_nombre}}</td>
                            <td>{{ $producto->prod_descripcion}}</td>
                            <td>{{ $producto->prod_cant }}</td>
                            <td>{{ $producto->prod_precioventa }}</td>
                            <td>{{ $producto->prod_preciocosto }}</td>
                            <td>{{ ($producto->prod_precioventa)*($producto->prod_cant) }}</td>
                        </tr>
                        @php
                            $totalGeneral += ($producto->prod_precioventa * $producto->prod_cant);
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
        <p><span style="float:right;"><strong>Total General:</strong> {{ $totalGeneral }}</span></p>

        @php
            $totalGeneral = 0;
            $contador = 1;
        @endphp
        <h3>Productos con stock suficiente</h3>
        <table class="details">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Stock disponible</th>
                    <th>Precio de venta</th>
                    <th>Precio de compra</th>
                    <th>Total Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos['stock'] as $producto)
                    @if ($producto->prod_cant >= $stock_min)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $producto->prod_nombre }}</td>
                            <td>{{ $producto->categoria->cat_nombre}}</td>
                            <td>{{ $producto->prod_descripcion}}</td>
                            <td>{{ $producto->prod_cant }}</td>
                            <td>{{ $producto->prod_precioventa }}</td>
                            <td>{{ $producto->prod_preciocosto }}</td>
                            <td>{{ ($producto->prod_precioventa)*($producto->prod_cant) }}</td>
                        </tr>
                        @php
                            $totalGeneral += ($producto->prod_precioventa * $producto->prod_cant);
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
        <p><span style="float:right;"><strong>Total General:</strong> {{ $totalGeneral }}</span></p>
    @else
        <p>No se encontraron datos para el tipo de reporte seleccionado.</p>
    @endif
</body>
</html>
