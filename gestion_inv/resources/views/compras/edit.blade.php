<head>
    <title>Stocking - Editar detalle de Compra</title>
    @include('layouts.head') 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> <!-- Agregado script de Select2 -->

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
                            <div class="card-header Frojo-Lblanco">Editar Venta</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('compras.update', ['temp_id' => $temp_compra_detalles->temp_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <div class="form-group">
                                        <input type="text" name="producto" id="producto" class="form-control" value="{{ $temp_compra_detalles->prod_id }}" hidden>
                                        <label for="prod_id">Producto:</label>
                                        <select name="prod_id" id="prod_id" class="select2-container-selection__rendered form-control js-example-basic-multiple select2" required>
                                            <?php
                                                // Obtener todos los productos y ordenarlos por el nombre
                                                $productos = App\Models\Producto::orderBy('prod_nombre')->get();
                                            ?>
                                            <option value="">Seleccione una Opción</option>
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}" {{ $producto->prod_id == optional($temp_compra_detalles->producto)->prod_id ? 'selected' : '' }}>
                                                    {{ $producto->prod_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dcompra_cantidad">Cantidad:</label>
                                        <input type="number" name="dcompra_cantidad" id="dcompra_cantidad" class="form-control" value="{{ $temp_compra_detalles->dcompra_cantidad }}" required>
                                    </div>

                                    <input type="hidden" name="pcompra" id="pcompra" value="">
                                    <div class="form-group">
                                        <label for="dcompra_pcompra">Precio Compra:</label>
                                        <input type="number" class="form-control" name="dcompra_pcompra" id="dcompra_pcompra" placeholder="Precio Compra" value="{{ $temp_compra_detalles->dcompra_pcompra }}" required>
                                    </div>
                                    <input type="hidden" name="pventa" id="pventa" value="">
                                    <div class="form-group">
                                        <label for="dcompra_pventa">Precio Venta:</label>
                                        <input type="number" class="form-control" name="dcompra_pventa" id="dcompra_pventa" placeholder="Precio Venta" value="{{ $temp_compra_detalles->dcompra_pventa }}" required>
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
        $(document).ready(function() {
            // Manejar el cambio en la selección del producto
            $('#prod_id').on('change', function(){
                // Obtener el valor seleccionado
                var selectedProductId = $(this).val();

                if (selectedProductId !== '') {
                    // Obtener el precio del producto desde el atributo data-precio
                    var selectedProductPrice = $('option:selected', this).data('precio');
                    // Establecer el precio en el campo de entrada
                    $('#dcompra_precio').val(selectedProductPrice);
                    // Actualizar el campo oculto de precio si es necesario
                    $('#precio').val(selectedProductPrice);
                } else {
                    // Limpiar el campo de precio si no se seleccionó ningún producto
                    $('#dcompra_precio').val('');
                    $('#precio').val('');
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
                        url: '{{ url("/verificar-producto-compra") }}/' + selectedProductId,
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
                                        window.location.href = '{{ url("/compras") }}';
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
        });

        $(document).ready(function() {
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
