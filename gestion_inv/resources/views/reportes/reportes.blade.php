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
</style>

@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

    <div class="content vista">
        <h1 class="mt-4">Generar Reporte</h1>

        <form action="{{ route('reportes.pdf') }}" method="GET">
            <div class="form-group">
                <label for="tipo_reporte">Tipo de reporte:</label>
                <select class="form-control" id="tipo_reporte" name="tipo_reporte" required>
                    <option value="vacio">Seleccione una opción</option>
                    <option value="ventas">Ventas</option>
                    <option value="compras">Compras</option>
                </select>
            </div>
            <div class="form-group" id="div_proveedor" style="display: none;">
                <label for="nombre_proveedor">Proveedor:</label>
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
            <div class="form-group" id="div_cliente" style="display: none;">
                <label for="nombre_cliente">Cliente:</label>
                <select name="cli_id" id="cliente" class="select2-container-selection__rendered form-control js-example-basic-single select2" required>
                    <?php
                        // Obtener todos los proveedores y ordenarlos por el nombre
                        $clientes = App\Models\Cliente::orderBy('cli_nombre')->get();
                    ?>
                    <option value="">Seleccione una Opción</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->cli_id }}">{{ $cliente->cli_nombre }} {{ $cliente->cli_apellido }} - {{ $cliente->cli_ruc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
            <button type="submit" class="btn btnAccion">Generar Reporte</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidad JS de Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tipo_reporte').change(function() {
                var tipoReporte = $(this).val();
                if (tipoReporte === 'ventas') {
                    $('#div_proveedor').hide().find('select').prop('required', false);
                    $('#div_cliente').show().find('select').prop('required', true);
                } else if (tipoReporte === 'compras') {
                    $('#div_cliente').hide().find('select').prop('required', false);
                    $('#div_proveedor').show().find('select').prop('required', true);
                } else {
                    $('#div_cliente').hide().find('select').prop('required', false);
                    $('#div_proveedor').hide().find('select').prop('required', false);
                }
            });
        });

        $(document).ready(function() {
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
