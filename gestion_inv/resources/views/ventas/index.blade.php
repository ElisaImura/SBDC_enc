<head>
    <title>Easy System - Ventas</title>
    @include('layouts.head')   
</head> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

    <div class="content" id="ventas-vista">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mt-4 row justify-content-center">
                
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong>Nueva Venta</strong>
                        </div>
                        <div class="card-body">
                            <form id="form-ventas" method="post" action="{{ route('DetalleTemp.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="prod_id">Producto:</label>
                                    <select name="prod_id" id="prod_id" class="form-control" required>
                                        <option value="">Seleccione una Opción</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}">{{ $producto->prod_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                            
                                <div class="form-group">
                                    <label for="dventa_cant">Cantidad</label>
                                    <input type="number" class="form-control" name="dventa_cantidad" id="dventa_cantidad" placeholder="Cantidad" required>
                                </div>
                            
                                <input type="hidden" name="precio" id="precio" value="">
                                <div class="form-group">
                                    <label for="dventa_precio">Precio</label>
                                    <input type="number" class="form-control" name="dventa_precio" id="dventa_precio" placeholder="Precio" required readonly>
                                </div>
                            
                                <div class="form-group">
                                    <label for="total"></label>
                                    <input type="number" class="form-control" name="total" id="total" placeholder="Total" required readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                            
                    </div>

                    <div class="container">
                        <form id="form-concretarV" method="post" action="{{ route('ventas.concretarVenta') }}">
                            @csrf
                            <div class="form-group">
                                <label for="cli_id">Cliente:</label>
                                <select name="cli_id" id="cliente" class="form-control" required>
                                    <option value="">Seleccione una Opción</option>
                                    @foreach($clientes as $cli_id => $cli_nombre)
                                        <option value="{{ $cli_id }}">{{ $cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Concretar venta</button>
                        </form>
                      </div>
                </div>


            </div>
                
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
                                    @if (Schema::hasTable('temp_venta_detalles'))
                                    @foreach ($temp_venta_detalles as $dventa)
                                    <tr id="row_{{ $dventa->temp_id }}">
                                        <td>{{ $dventa->temp_id ?? 'NN' }}</td>
                                        <td>{{ $dventa->producto->prod_nombre }}</td>
                                        <td>{{ $dventa->dventa_cantidad }}</td>
                                        <td>{{ $dventa->dventa_precio }}</td>
                                        <td>{{$dventa->total}}</td>
                                            <td class="text-center">
                                                <div id="btn-pro" class="botones">
                                                    <form action="{{ route('ventas.destroy', ['temp_id' => $dventa->temp_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                              </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('ventas.edit', ['temp_id' => $dventa->temp_id]) }}">                                   
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
</div>

    @include('layouts.footer') 

<script href="{{asset('./js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    
    $(document).ready(function () {
    // Manejar el cambio en la selección del producto
    $('#prod_id').change(function () {
        // Obtener el valor seleccionado
        var selectedProductId = $(this).val();
        $.ajax({
            url: '/verificar-producto/' + selectedProductId,
            type: 'GET',
            success: function(response) {
                // Verificar la respuesta del servidor
                if (response.existe) {
                    // Si el producto existe, mostrar un SweetAlert con el botón personalizado
                    var detalleId = response.temp_id;
                     $('#form-ventas')[0].reset();
                    Swal.fire({
                        title: 'Este producto ya está agregado',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Editar Detalle', // Cambiar el texto del botón
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirigir al usuario al formulario de edición del detalle temporal correspondiente
                            window.location.href = '/ventas/' + detalleId + '/edit';
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                // Manejar el error si ocurre
                console.error(error);
            }
        });
        if (selectedProductId !== 'opcion') {
            // Obtener el precio del producto desde el atributo data-precio
            var selectedProductPrice = $('option:selected', this).data('precio');
            // Establecer el precio en el campo de entrada
            $('#dventa_precio').val(selectedProductPrice);
            // Actualizar el campo oculto de precio si es necesario
            $('#precio').val(selectedProductPrice);
            // Calcular el total cuando cambia el producto (precio y cantidad)
            calcularTotal();
        } else {
            // Limpiar el campo de precio si la opción seleccionada es "Seleccione una Opción"
            $('#dventa_precio').val('');
            $('#precio').val('');
            // Limpiar el campo de total
            $('#total').val('');
        }
    });



    // Manejar el cambio en la cantidad
    document.getElementById('dventa_cantidad').addEventListener('change', function() {
        var cantidadIngresada = parseInt(document.getElementById("dventa_cantidad").value);
        var cantidadDisponibleEnTabla = parseInt($('#prod_id option:selected').data('cantidad'));
        // Calcular el total cuando cambia la cantidad
        if (cantidadIngresada > cantidadDisponibleEnTabla) {
            // Si la cantidad ingresada es mayor, mostrar un mensaje de alerta
            alert("La cantidad ingresada excede la cantidad disponible en la tabla de productos.");
        } else {
            // Si la cantidad ingresada es menor o igual, mostrar un mensaje de éxito
            calcularTotal();
        }
       
    });

    // Manejar el cambio en el precio
    document.getElementById('dventa_precio').addEventListener('change', function() {
        // Calcular el total cuando cambia el precio
        calcularTotal();
    });

    function calcularTotal() {
        var cantidad = parseFloat($('#dventa_cantidad').val());
        var precio = parseFloat($('#precio').val());

        // Verificar si tanto cantidad como precio tienen valores
        if (!isNaN(cantidad) && !isNaN(precio)) {
            var total = Math.round(cantidad * precio);

            if (!isNaN(total)) {
                $('#total').val(total);

                // Obtén la fila actual y actualiza el total en la columna correspondiente
                var currentRow = document.getElementById('current_row_id'); // Reemplaza 'current_row_id' con la clase o ID específico de la fila actual
            } else {
                $('#total').val('');
            }
        }
    }

    function verificarCantidad() {
        // Obtener el valor de la cantidad ingresada por el usuario
        var cantidadIngresada = parseInt(document.getElementById("dventa_cantidad").value);
        
        // Obtener la cantidad de productos disponibles desde la tabla de productos (reemplaza esto con tu lógica de cómo obtienes los datos de la tabla)
        var cantidadDisponibleEnTabla = 10; // Aquí deberías obtener la cantidad real de la tabla de productos
        
        // Verificar si la cantidad ingresada por el usuario es mayor que la cantidad disponible en la tabla de productos
        if (cantidadIngresada > cantidadDisponibleEnTabla) {
            // Si la cantidad ingresada es mayor, mostrar un mensaje de alerta
            alert("La cantidad ingresada excede la cantidad disponible en la tabla de productos.");
        } else {
            // Si la cantidad ingresada es menor o igual, mostrar un mensaje de éxito
            alert("La cantidad ingresada es válida.");
        }
    }
});

$(document).ready(function() {
    $('#form-ventas').submit(function(event) {
        if ($('#prod_id').val() == '') {
            alert('Por favor, seleccione un producto.');
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
});

$(document).ready(function() {
    $('#form-concretarV').submit(function(event) {
        if ($('#cliente').val() == '') {
            alert('Por favor, seleccione un cliente.');
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
});


</script>

</body>
</html>
