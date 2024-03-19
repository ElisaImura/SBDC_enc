<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy System - Editar Cliente</title>
    @include('layouts.head')
    <style>
        .custom-bg-color {
            background-color: #e1e2e3;
        }

        .custom-header-color {
            background-color: #343A40; 
        }
        p{
            font-size: 20px;
        }
        .card-body{
            min-height: 120px;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content vista">
            <div class="container">
                <h1 class="titulo_principal text-center">Panel de Control</h1>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Compras</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalCompras }}</strong> compras realizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Ventas</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalVentas }}</strong> ventas realizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Productos</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalProductos }}</strong> productos existentes</p>
                                    @if ($totalCritico!=0)
                                        <a href="{{ route('productos.index') }}" class="card-text" style="font-size: 20px; color: red"><strong>{{ $totalCritico }}</strong> productos con stock crítico</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Clientes</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalClientes }}</strong> clientes registrados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Proveedores</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalProveedores }}</strong> proveedores registrados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-bg-color mb-3">
                                <div class="card-header text-white custom-header-color">Categorias</div>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $totalCategorias }}</strong> categorias existentes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="text-muted" href="{{ asset('manual.pdf') }}">Manual de usuario</a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
