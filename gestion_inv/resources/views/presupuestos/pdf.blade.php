<head>
    <title>Easy System - presupuesto</title>
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; /* Evita márgenes predeterminados en el cuerpo del documento */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px; /* Reduce el margen superior */
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 4px; /* Reduce el espacio interno de las celdas */
            text-align: left;
            font-size: 14px; /* Disminuye el tamaño de la fuente en la tabla */
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-align: center; /* Centra el texto en las celdas del encabezado */
        }

        .card {
            margin-top: 5px; /* Reduce el margen superior */
        }

        h1 {
            text-align: center; /* Centra el texto del encabezado principal */
            margin-top: 20px; /* Ajusta el margen superior del encabezado principal */
        }
    </style>
</head> 

<body>
  
<div id="main-container">
    <h1>Presupuesto de Venta</h1>

    <div class="content" id="presupuesto-vista">
        <div class="container">                
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Schema::hasTable('Presupuesto_temp_venta_detalles'))
                                @foreach ($Presupuesto_temp_venta_detalles as $dventa)
                                <tr id="row_{{ $dventa->temp_id }}">
                                    <td>{{ $dventa->temp_id ?? 'NN' }}</td>
                                    <td>{{ $dventa->producto->prod_nombre }}</td>
                                    <td>{{ $dventa->dventa_cantidad }}</td>
                                    <td>{{ $dventa->dventa_precio }}</td>
                                    <td>{{$dventa->total}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            
                            </tbody>
                        </table>
                        <div class="row justify-content-between">
                            <div class="col-md-5">
                                <strong><p id="TextoTotal">Total: </strong>{{ $totalDetalles }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
