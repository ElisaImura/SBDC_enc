<head>
    <title>Easy System - reportes</title>
    @include('layouts.head')   
</head> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
                <select class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
                    <option value="">Seleccione un proveedor</option>
                    <option value="todo">Todo</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->prove_nombre }}">{{ $proveedor->prove_nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="div_cliente" style="display: none;">
                <label for="nombre_cliente">Cliente:</label>
                <select class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                    <option value="">Seleccione un cliente</option>
                    <option value="todo">Todo</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->cli_nombre }}">{{ $cliente->cli_nombre }} {{ $cliente->cli_apellido }}</option>
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
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
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
    </script>
</div>
@include('layouts.footer') 
</body>
</html>
