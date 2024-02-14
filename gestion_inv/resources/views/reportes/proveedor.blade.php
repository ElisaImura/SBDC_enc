<head>
    <title>Easy System - reportes</title>
    @include('layouts.head')   
</head> 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@include('layouts.navbar') 

<body>
  
<div id="main-container">
    @include('layouts.sidebar')

    <div class="content" id="reporte-vista">
        <h1 class="mt-4">Generar Reporte de Compra</h1>

        <form action="{{ route('reportes.pdf') }}" method="GET">
            <div class="form-group">
                <label for="nombre_proveedor">Proveedor:</label>
                <select class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
                    <option value="">Seleccione un proveedor</option>
                    <option value="todo">Todo</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->prove_nombre }}">{{ $proveedor->prove_nombre }}</option>
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
            <div class="form-group">
                <label for="tipo_reporte">Tipo de reporte:</label>
                <select class="form-control" id="tipo_reporte" name="tipo_reporte" readonly>
                    <option value="compras">Compras</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidad JS de Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
@include('layouts.footer') 
</body>
</html>
