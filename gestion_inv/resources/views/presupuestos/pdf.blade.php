<head>
    <title>Easy System - presupuesto</title>
    @include('layouts.head')   
</head> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

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
                                    <th class="text-center" style="width: 100px;">Acciones</th>
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
                                        <td class="text-center">
                                            <div id="btn-pro" class="botones">
                                                <form action="{{ route('presupuesto.destroy', ['temp_id' => $dventa->temp_id]) }}" method="POST" id="formEliminarVenta-{{ $dventa->temp_id }}" data-id="{{ $dventa->temp_id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btnEliminarVenta">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('presupuesto.edit', ['temp_id' => $dventa->temp_id]) }}">                                   
                                                    <button class="btn btn-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('layouts.footer') 

<script href="{{asset('./js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    
    $(document).ready(function () {
        // Manejar el cambio en la selección del producto

        console.log(calcularTotalAcumulado());

        // Calcula el total acumulado al cargar la página
        var totalAcumulado = calcularTotalAcumulado();

        // Muestra el total acumulado en la página
        mostrarTotalAcumulado(totalAcumulado);

        function calcularTotalAcumulado() {
            var totalAcumulado = 0;
            // Recorre cada fila de la tabla y suma los totales
            $('table tbody tr').each(function () {
                var totalDetalle = parseFloat($(this).find('td:eq(4)').text());
                if (!isNaN(totalDetalle)) {
                    totalAcumulado += totalDetalle;
                }
            });
            return totalAcumulado;
        }

        function mostrarTotalAcumulado(totalAcumulado) {
            if (totalAcumulado > 0) {
                $('#total-value').text(totalAcumulado);
            } else {
                $('#total-value').text(" -");
            }
        }

    });

</script>

</body>
</html>
