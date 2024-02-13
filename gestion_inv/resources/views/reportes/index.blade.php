<!-- resources/views/reporte/formulario.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Generar Reporte</title>
</head>
<body>
    <h1>Generar Reporte</h1>

    <form action="{{ route('reportes.pdf') }}" method="GET">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        <br>
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <br>
        <label for="tipo_reporte">Tipo de reporte:</label>
        <select id="tipo_reporte" name="tipo_reporte" required>
            <option value="ventas">Ventas</option>
            <option value="compras">Compras</option>
        </select>
        <br>
        <button type="submit">Generar Reporte</button>
    </form>
</body>
</html>
