<head>
    <title>Easy System - Compras</title>
    @include('layouts.head')   
</head> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    /* Estilo para el placeholder en Select2 */
    .select2-container .select2-selection--single .select2-selection__placeholder {
        color: #6C757D !important;
    }
</style>
@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

    <div class="content vista">
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
                            <strong>Nueva Compra</strong>
                        </div>
                        <div class="card-body">
                            <form id="form-compras" method="post" action="{{ route('DetalleTempCompra.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="prod_id">Producto:</label>
                                    <select name="prod_id" id="prod_id" class="select2-container-selection__rendered form-control js-example-basic-single select2" required>
                                        <?php
                                            // Obtener todos los productos y ordenarlos por el nombre
                                            $productos = App\Models\Producto::orderBy('prod_nombre')->get();
                                        ?>
                                        <option value="">Seleccione una Opción</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}">{{ $producto->prod_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                            
                                <div class="form-group">
                                    <label for="dcompra_cantidad">Cantidad</label>
                                    <input type="number" class="form-control" name="dcompra_cantidad" id="dcompra_cantidad" placeholder="Cantidad" required>
                                </div>
                            
                                <input type="hidden" name="pcompra" id="pcompra" value="">
                                <div class="form-group">
                                    <label for="dcompra_pcompra">Precio Compra</label>
                                    <input type="number" class="form-control" name="dcompra_pcompra" id="dcompra_pcompra" placeholder="Precio Compra" required>
                                </div>
                                <input type="hidden" name="pventa" id="pventa" value="">
                                <div class="form-group">
                                    <label for="dcompra_pventa">Precio Venta</label>
                                    <input type="number" class="form-control" name="dcompra_pventa" id="dcompra_pventa" placeholder="Precio Venta" required>
                                </div>
                                <button id="botonEnviar" type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                            
                    </div>

                    <div class="container">
                        <form id="form-concretarCompra" method="post" action="{{ route('compras.concretarCompra') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="prove_id">Proveedor:</label>
                                    <select name="prove_id" id="proveedor" class="select2-container-selection__rendered form-control js-example-basic-single select2" placeholder="Buscar" required>
                                        <?php
                                            // Obtener todos los proveedores y ordenarlos por el nombre
                                            $proveedores = App\Models\Proveedor::orderBy('prove_nombre')->get();
                                        ?>
                                        <option value="">Seleccione una Opción</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->prove_id }}">{{ $proveedor->prove_nombre }} - {{ $proveedor->prove_ruc }}</option>
                                        @endforeach
                                    </select>
                                </div>                               
                                <div class="form-group">
                                    <label for="compra_factura">Factura N°</label>
                                    <input type="number" class="form-control" name="compra_factura" id="compra_factura_input" placeholder="Numero de Factura" required>
                                </div>
                             </div>
                            <button type="submit" class="btn btn-primary">Concretar compra</button>
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
                                        <th>Compra</th>
                                        <th>Venta</th>
                                        <th class="text-center" style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Schema::hasTable('temp_compra_detalles'))
                                    @foreach ($temp_compra_detalles as $dcompra)
                                    <tr id="row_{{ $dcompra->temp_id }}">
                                        <td>{{ $dcompra->temp_id ?? 'NN' }}</td>
                                        <td>{{ $dcompra->producto->prod_nombre }}</td>
                                        <td>{{ $dcompra->dcompra_cantidad }}</td>
                                        <td>{{ $dcompra->dcompra_pcompra}}</td>
                                        <td>{{ $dcompra->dcompra_pventa}}</td>
                                        
                                            <td class="text-center">
                                                <div id="btn-pro" class="botones">
                                                    <form action="{{ route('compras.destroy', ['temp_id' => $dcompra->temp_id]) }}" method="POST" id="formEliminarCompra-{{ $dcompra->temp_id }}" data-id="{{ $dcompra->temp_id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btnEliminarCompra" id="btnEliminarCompra-{{ $dcompra->temp_id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    
                                                    
                                                    
                                                    <form action="{{ route('compras.edit', ['temp_id' => $dcompra->temp_id]) }}">                                   
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
                url: './verificar-producto-compra/' + selectedProductId,
                type: 'GET',
                success: function(response) {
                    // Verificar la respuesta del servidor
                    if (response.existe) {
                        $('#form-compras')[0].reset();
                        // Si el producto existe, mostrar un SweetAlert con el botón personalizado
                        var detalleId = response.temp_id;

                        Swal.fire({
                            title: 'Este producto ya está agregado',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Editar Detalle', // Cambiar el texto del botón
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirigir al usuario al formulario de edición del detalle temporal correspondiente
                                window.location.href = './compras/' + detalleId + '/edit';
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar el error si ocurre
                    console.error(error);
                }
            });
        });

        $('#dcompra_pventa').change(function () {
            // Obtener el valor de pventa y pcompra
            var pventa = parseInt($(this).val());
            var pcompra = parseInt($('#dcompra_pcompra').val());

            // Verificar si pventa es menor que pcompra
            if (pventa < pcompra) {
            // Limpiar el campo de entrada
                $(this).val('');
                // Mostrar el alert
                Swal.fire({
                    title: 'El precio de venta es menor al precio de compra',
                    text: '¿Está seguro de continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#dcompra_pventa').val(pventa);
                    }
                });
            }
        });
        

        window.addEventListener('load', function() {
            var formsEliminar = document.querySelectorAll('form[id^="formEliminarCompra-"]');

            // Itera sobre cada formulario de eliminar
            formsEliminar.forEach(function(formEliminar) {
                // Obtiene el botón de eliminar dentro del formulario actual
                var btnEliminarCompra = formEliminar.querySelector('.btnEliminarCompra');
            });
        });

        inputFactura = document.getElementById('compra_factura_input');

        // Agregar un event listener para verificar la unicidad del número de factura al cambiar su valor
        inputFactura.addEventListener('change', function() {
            // Obtener el valor del número de factura
            const facturaValue = inputFactura.value;

            // Realizar una petición AJAX para verificar si el número de factura ya existe
            fetch('./verificarFactura/${facturaValue}')
                .then(response => response.json())
                .then(data => {
                    // Si el número de factura ya existe, mostrar un mensaje de error
                    if (data.exists) {
                        alert('El número de factura ya existe. Debe ser único.');
                        // Limpiar el valor del input para que el usuario pueda ingresar un nuevo número
                        inputFactura.value = '';
                        // Enfocar nuevamente en el input para que el usuario pueda ingresar un nuevo número
                        inputFactura.focus();
                    }
                })
                .catch(error => console.error('Error al verificar el número de factura:', error));
        });

    });


    //Hay que mejorar esta seccion porque no funciona siempre. Como que tarda en cargar.
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('tbody').addEventListener('click', function(event) {
            if (event.target && event.target.matches('.btnEliminarCompra')) {
                var formulario = event.target.closest('form');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formulario.submit();
                    }
                });
            }
        });
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
            'color': '#6C757D',
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
            'color': '#6C757D',
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
            'color': '#6C757D',
            'padding': '0px',
        });
    });

</script>

</body>
</html>