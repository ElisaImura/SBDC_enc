<head>
    <title>Easy System - reportes</title>
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
    /* Estilo para los checkboxes */
    .checkbox-group {
        display: inline-block;
        margin-right: 10px;
    }
</style>

@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

    <div class="content vista">
        <div class="container">
            <h1 class="titulo_principal text-center">Generar Reporte</h1>

            <form id="reporteForm" action="{{ route('reportes.pdf') }}" method="GET">
                <div class="form-group" style="margin-bottom: 40px;">
                    <h4>Tipo de reporte:</h4>
                    <div class="checkbox-group">
                        <label for="tipo_ventas">Ventas</label>
                        <input type="checkbox" id="tipo_ventas" name="tipo_ventas" value="ventas">
                    </div>
                    <div class="checkbox-group">
                        <label for="tipo_compras">Compras</label>
                        <input type="checkbox" id="tipo_compras" name="tipo_compras" value="compras">
                    </div>
                    <div id="div_proveedor" style="display: none;">
                        <label for="nombre_proveedor">Proveedor:</label>
                        <select name="prove_id" id="proveedor" class="select2-container-selection__rendered form-control js-example-basic-single select2" placeholder="Buscar">
                            <?php
                                // Obtener todos los proveedores y ordenarlos por el nombre
                                $proveedores = App\Models\Proveedor::orderBy('prove_nombre')->get();
                            ?>
                            <option value="">Seleccione una Opción</option>
                            <option value="todo">Todo</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->prove_id }}">{{ $proveedor->prove_nombre }} - {{ $proveedor->prove_ruc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="div_cliente" style="display: none;">
                        <label for="nombre_cliente">Cliente:</label>
                        <select name="cli_id" id="cliente" class="select2-container-selection__rendered form-control js-example-basic-single select2">
                            <?php
                                // Obtener todos los proveedores y ordenarlos por el nombre
                                $clientes = App\Models\Cliente::orderBy('cli_nombre')->get();
                            ?>
                            <option value="">Seleccione una Opción</option>
                            <option value="todo">Todo</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->cli_id }}">{{ $cliente->cli_nombre }} {{ $cliente->cli_apellido }} - {{ $cliente->cli_ruc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="fecha_div" style="margin-bottom: 30px;">
                    <div>
                        <h4>Rango de datos:</h4>
                        <div class="checkbox-group">
                            <label for="todo">Todo</label>
                            <input type="checkbox" id="todo" name="todo">
                        </div>
                        <div class="checkbox-group">
                            <label for="periodo_tiempo">Seleccionar un periodo de tiempo</label>
                            <input type="checkbox" id="periodo_tiempo" name="periodo_tiempo">
                        </div>
                    </div>
                    <div id="fechas" style="display: none;">
                        <div style="margin-bottom: 10px;">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div>
                            <label for="fecha_fin">Fecha de fin:</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btnAccion">Generar Reporte</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidad JS de Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener referencia al input de fecha de inicio
            const fechaInicioInput = document.getElementById('fecha_inicio');

            // Agregar un event listener para el evento 'change' al input de fecha de inicio
            fechaInicioInput.addEventListener('change', function() {
                // Obtener la fecha de inicio seleccionada por el usuario
                const fechaInicioSeleccionada = new Date(this.value);

                // Obtener la fecha actual
                const fechaActual = new Date();

                // Verificar si la fecha de inicio seleccionada es posterior a la fecha actual
                if (fechaInicioSeleccionada > fechaActual) {
                    this.value = '';
                    Swal.fire({
                        title: 'Fecha inválida',
                        text: "La fecha de inicio debe ser igual o posterior a la fecha actual",
                        icon: 'warning',
                        confirmButtonColor: '#1B2E51',
                        confirmButtonText: 'Entendido',
                    });
                }
            });
        });
        $(document).ready(function() {
            // Función para validar el formulario antes de enviarlo
            // Agregar un evento de escucha para el evento submit del formulario
            document.getElementById('reporteForm').addEventListener('submit', function(event) {
                // Evitar que se envíe el formulario automáticamente
                event.preventDefault();

                // Validar los datos del formulario
                const tipoVentas = document.getElementById('tipo_ventas').checked;
                const tipoCompras = document.getElementById('tipo_compras').checked;
                const proveedor = document.getElementById('proveedor').value;
                const cliente = document.getElementById('cliente').value;
                const todo = document.getElementById('todo').checked;
                const periodoTiempo = document.getElementById('periodo_tiempo').checked;
                const fechaInicio = document.getElementById('fecha_inicio').value;
                const fechaFin = document.getElementById('fecha_fin').value;

                // Realizar la validación de los datos según tus requerimientos
                // Por ejemplo, podrías verificar que se haya seleccionado al menos un tipo de reporte
                if (!tipoVentas && !tipoCompras) {
                    Swal.fire({
                        title: 'No seleccionó el tipo de reporte',
                        text: "Necesita seleccionar al menos un tipo de reporte",
                        icon: 'warning',
                        confirmButtonColor: '#1B2E51',
                        confirmButtonText: 'Entendido',
                    });
                    return; // Evitar que el formulario se envíe si no se selecciona ningún tipo de reporte
                }

                if (!todo && !periodoTiempo) {
                    Swal.fire({
                        title: 'No seleccionó el rango de datos',
                        text: "Necesita seleccionar el rango de datos",
                        icon: 'warning',
                        confirmButtonColor: '#1B2E51',
                        confirmButtonText: 'Entendido',
                    });
                    return; // Evitar que el formulario se envíe si no se selecciona ningún tipo de reporte
                }

                // Convertir las cadenas de fecha en objetos de fecha para compararlas
                const fechaInicioObj = new Date(fechaInicio);
                const fechaFinObj = new Date(fechaFin);

                // Validar si la fecha de fin es anterior a la fecha de inicio
                if (fechaFinObj < fechaInicioObj) {
                    Swal.fire({
                        title: 'Fecha inválida',
                        text: "La fecha de fin debe ser igual o posterior a la fecha de inicio",
                        icon: 'warning',
                        confirmButtonColor: '#1B2E51',
                        confirmButtonText: 'Entendido',
                    });
                    return;
                }

                // Si todas las validaciones pasan, enviar el formulario
                this.submit();
            });

            // Mostrar u ocultar las secciones de proveedor o cliente según el tipo de reporte seleccionado
            $('#tipo_ventas').change(function() {
                if ($(this).is(':checked')) {
                    $('#div_proveedor').hide();
                    $('#div_cliente').show();
                    $('#tipo_compras').prop('checked', false);
                    $('#cliente').prop('required', true); // Hacer el campo obligatorio
                    $('#proveedor').prop('required', false);
                    $('#proveedor').val('').trigger('change');
                } else {
                    $('#div_cliente').hide();
                    $('#cliente').prop('required', false); // No requerir el campo si no está visible
                }
            });

            $('#tipo_compras').change(function() {
                if ($(this).is(':checked')) {
                    $('#div_cliente').hide();
                    $('#div_proveedor').show();
                    $('#tipo_ventas').prop('checked', false);
                    $('#proveedor').prop('required', true); // Hacer el campo obligatorio
                    $('#cliente').prop('required', false);
                    $('#cliente').val('').trigger('change');
                } else {
                    $('#div_proveedor').hide();
                    $('#proveedor').prop('required', false); // No requerir el campo si no está visible
                }
            });

            // Mostrar u ocultar las fechas dependiendo del checkbox seleccionado
            $('#periodo_tiempo').change(function() {
                if ($(this).is(':checked')) {
                    $('#fechas').show();
                    $('#todo').prop('checked', false);
                    $('#fecha_inicio').prop('required', true); // Hacer los campos obligatorios
                    $('#fecha_fin').prop('required', true);
                } else {
                    $('#fechas').hide();
                    $('#fecha_inicio').prop('required', false); // No requerir los campos si no están visibles
                    $('#fecha_fin').prop('required', false);
                    $('#fecha_inicio').val(''); // Borrar fechas
                    $('#fecha_fin').val('');
                }
            });

            $('#todo').change(function() {
                if ($(this).is(':checked')) {
                    $('#fechas').hide();
                    $('#periodo_tiempo').prop('checked', false);
                    $('#fecha_inicio').prop('required', false); // No requerir los campos si no están visibles
                    $('#fecha_fin').prop('required', false);
                }
            });

            $('#cliente').select2({
                placeholder: 'Seleccionar Cliente',
                width: '100%',
            });

            $('#proveedor').select2({
                placeholder: 'Seleccionar Proveedor',
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
</div>
@include('layouts.footer') 
</body>
</html>
