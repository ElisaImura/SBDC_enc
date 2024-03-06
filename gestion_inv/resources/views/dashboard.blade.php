<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy System - Editar Cliente</title>
    @include('layouts.head')
    <style>
        .custom-bg-color {
            background-color: #77ace0;
        }

        .custom-header-color {
            background-color: #3976b3; 
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
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Compras</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalCompras }}</h5>
                                    <p class="card-text">Cantidad de compras realizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Ventas</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalVentas }}</h5>
                                    <p class="card-text">Cantidad de ventas realizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Productos</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalProductos }}</h5>
                                    <p class="card-text">Cantidad de productos existentes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Clientes</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalClientes }}</h5>
                                    <p class="card-text">Cantidad de clientes registrados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Proveedores</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalProveedores }}</h5>
                                    <p class="card-text">Cantidad de proveedores registrados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white custom-bg-color mb-3">
                                <div class="card-header custom-header-color">Categorias</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalCategorias }}</h5>
                                    <p class="card-text">Cantidad de categorias existentes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
