<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <style>
        /* Estilos CSS aquí */
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Eliminar el margen predeterminado del cuerpo para centrar en la página completa */
            padding: 0;
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            height: 100vh; /* Altura del viewport */
            font-size: 12px;
        }
        h1 {
            text-align: center;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Clientes</h1>
        @if ($clientes->isEmpty())
            <p>No se encontraron resultados para la búsqueda.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>CI</th>
                        <th>Correo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Estado</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre ?? 'NN' }}</td>
                            <td>{{ $cliente->apellido ?? 'NN' }}</td>
                            <td>{{ $cliente->edad ?? 'NN'}}</td>
                            <td>{{ $cliente->ci ?? 'NN'}}</td>
                            <td>{{ $cliente->correo ?? 'NN' }}</td>
                            <td>{{ $cliente->fecha_nac ?? 'NN'}}</td>
                            <td>
                                @if ($cliente->estado == 'Activo' || $cliente->estado == 'activo')
                                    <span style="color: blue;">{{$cliente->estado}}</span>
                                @else
                                    <span style="color: orange;">{{$cliente->estado}}</span>
                                @endif
                            </td>
                            <td>
                                <strong>Nombre: </strong>{{ $cliente->cargo->nombre ?? 'NN' }} <br>
                                <strong>Sector: </strong>{{ $cliente->cargo->sector ?? 'NN' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
