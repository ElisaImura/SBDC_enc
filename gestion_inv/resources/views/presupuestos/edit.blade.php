<head>
    <title>Easy System - Editar Producto</title>
    @include('layouts.head') 
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    /* Estilo para el placeholder en Select2 */
    .select2-container .select2-selection--single .select2-selection__placeholder {
        color: #495057 !important;
    }
    /* Estilo para el hover del Select2 */
    .select2-container--default .select2-results__option[aria-selected=true]:hover,
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f0f0f0; /* Cambia este valor al gris que desees */
        color: black;
    }
</style>
@include('layouts.navbar')
<body>
    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">

                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header Frojo-Lblanco">Editar Detalle de Presupuesto</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('presupuesto.update', ['temp_id' => $Presupuesto_temp_venta_detalles->temp_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <div class="form-group">
                                        <input type="text" name="producto" id="producto" class="form-control" value="{{ $Presupuesto_temp_venta_detalles->prod_id }}" hidden>
                                        <label for="prod_id">Producto:</label>
                                        <select name="prod_id" id="prod_id" class="select2-container-selection__rendered form-control js-example-basic-single select2" required>
                                            <?php
                                                // Obtener todos los productos y ordenarlos por el nombre
                                                $productos = App\Models\Producto::orderBy('prod_nombre')->get();
                                            ?>
                                            <option value="">Seleccione una Opción</option>
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}" {{ $producto->prod_id == optional($Presupuesto_temp_venta_detalles->producto)->prod_id ? 'selected' : '' }}>
                                                    {{ $producto->prod_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dventa_cantidad">Cantidad:</label>
                                        <input type="number" name="dventa_cantidad" id="dventa_cantidad" class="form-control" value="{{ $Presupuesto_temp_venta_detalles->dventa_cantidad }}">
                                    </div>

                                    <input type="hidden" name="precio" id="precio" value="{{ $Presupuesto_temp_venta_detalles->dventa_precio }}">
                                    <div class="form-group">
                                        <label for="dventa_precio">Precio:</label>
                                        <input type="number" class="form-control" name="dventa_precio" id="dventa_precio" value="{{ $Presupuesto_temp_venta_detalles->dventa_precio }}" readonly>
                                    </div>
                                                                
                                    <div class="form-group">
                                        <label for="total">Total:</label>
                                        <input type="number" class="form-control" name="total" id="total" placeholder="Total" value="{{ $Presupuesto_temp_venta_detalles->total }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="botonEnviar" class="btn btnAccion">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            var updatingSelect = false; // Bandera para controlar la actualización del select

            // Manejar el cambio en la selección del producto
            $('#prod_id').on('change', function(){
                if (!updatingSelect) {
                    // Obtener el valor seleccionado
                    var selectedProductId = $(this).val();
                    $.ajax({
                        // Utiliza la URL absoluta en lugar de la ruta relativa
                        url: '{{ url("/presupuesto-verificar-producto") }}/' + selectedProductId,
                        type: 'GET',
                        success: function(response) {
                            // Verificar la respuesta del servidor
                            if (response.existe) {
                                updatingSelect = true; // Establecer la bandera en true para evitar bucles infinitos
                                // Obtener el valor del campo oculto #producto
                                var selectedProductId = $('#producto').val();
                                
                                // Establecer el valor seleccionado en el select #prod_id
                                $('#prod_id').val(selectedProductId).trigger('change');
                                updatingSelect = false; // Restablecer la bandera a false después de la actualización
                                // Si el producto existe, mostrar un SweetAlert con el botón personalizado
                                var detalleId = response.temp_id;
                                Swal.fire({
                                    title: 'Este producto ya está agregado',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Volver', // Cambiar el texto del botón
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirigir al usuario al formulario de edición del detalle temporal correspondiente
                                        window.location.href = '{{ url("/presupuesto") }}';
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Manejar el error si ocurre
                            console.error(error);
                        }
                    });
                }
            });

            // Manejar el cambio en la cantidad
            $('#dventa_cantidad').change(function() {
                var cantidadIngresada = parseInt($(this).val());
                var cantidadDisponibleEnTabla = "{{ $cantidad }}";

                if (cantidadIngresada > cantidadDisponibleEnTabla) {
                    // Si la cantidad ingresada es mayor, mostrar un mensaje de alerta
                    Swal.fire({
                        title: 'La cantidad ingresada excede a la cantidad disponible',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Entendido',
                    });

                    // Deshabilita el botón de enviar
                    $('#botonEnviar').prop('disabled', true);
                } else {
                    // Si la cantidad ingresada es menor o igual, calcular el total y habilitar el botón de enviar
                    calcularTotal();
                    $('#botonEnviar').prop('disabled', false);
                }
            });

            // Manejar el cambio en el precio
            $('#dventa_precio').change(function() {
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
                    } else {
                        $('#total').val('');
                    }
                }
            }
        });

        $(document).ready(function() {
            // Inicializar Select2 en el select de proveedores
            $('#proveedor').select2({
              placeholder: 'Seleccionar Proveedor',
              width: '100%',
            });

            $('#prod_id').select2({
              placeholder: 'Seleccionar Producto',
              width: '100%',
            });

            $('.select2-container .select2-selection--multiple').css({
                'color': '#495057',
                'border': '1px solid #ced4da',
                'height': 'calc(1.5em + 0.75rem + 2px)',
                'font-family': 'inherit',
            });

            /* Estilos para mantener la apariencia del select */
            $('.select2-container .select2-selection--single').css({
                'height': 'calc(1.5em + 0.75rem + 2px)',
                'padding': '0.375rem 0.75rem',
                'font-size': '1rem',
                'line-height': '1.5',
                'color': '#495057',
                'background-color': '#fff',
                'background-clip': 'padding-box',
                'border': '1px solid #ced4da',
                'border-radius': '0.25rem',
            });

            $('.select2-container .select2-selection--single .select2-selection__arrow').css({
                'height': 'calc(1.5em + 0.75rem)',
                'right': '5px',
                'top': 'auto',
                'bottom': '0',
            });

            $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
                'height': 'calc(1.5em + 0.75rem)',
                'margin-bottom': '10px',
                'line-height': '25px',
                'color': '#495057',
                'padding': '0px',
            });
        });
        
    </script>

    @include('layouts.footer') 
</body>
