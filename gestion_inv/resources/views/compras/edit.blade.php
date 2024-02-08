<head>
    <title>Easy System - Editar Producto</title>
    @include('layouts.head') 
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@include('layouts.navbar') 

<body>
    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">

                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Editar Venta</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('ventas.update', ['temp_id' => $temp_venta_detalles->temp_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <div class="form-group">
                                        <label for="prod_id">Producto:</label>
                                        <select name="prod_id" id="prod_id" class="form-control">
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}" {{ $producto->prod_id == optional($temp_venta_detalles->producto)->prod_id ? 'selected' : '' }}>
                                                    {{ $producto->prod_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dventa_cantidad">Cantidad:</label>
                                        <input type="number" name="dventa_cantidad" id="dventa_cantidad" class="form-control" value="{{ $temp_venta_detalles->dventa_cantidad }}">
                                    </div>

                                    <input type="hidden" name="precio" id="precio" value="{{ $temp_venta_detalles->dventa_precio }}">
                                    <div class="form-group">
                                        <label for="dventa_precio">Precio</label>
                                        <input type="number" class="form-control" name="dventa_precio" id="dventa_precio" value="{{ $temp_venta_detalles->dventa_precio }}" readonly>
                                    </div>
                                                                
                                    <div class="form-group">
                                        <label for="total">Total:</label>
                                        <input type="number" class="form-control" name="total" id="total" placeholder="Total" value="{{ $temp_venta_detalles->total }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            // Manejar el cambio en la selección del producto
            $('#prod_id').change(function () {
                // Obtener el valor seleccionado
                var selectedProductId = $(this).val();

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
        
        });

    </script>

    @include('layouts.footer') 

</body>
