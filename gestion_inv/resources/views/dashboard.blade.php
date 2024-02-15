<head>
    <title>Easy System - Editar Cliente</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>
    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content vista">
            <div class="container">
                <h1 class="titulo_principal text-center">Panel de Control</h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Compras</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalCompras }}</h5>
                        <p class="card-text">Cantidad de compras realizadas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Ventas</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalVentas }}</h5>
                        <p class="card-text">Cantidad de ventas realizadas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Productos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProductos }}</h5>
                        <p class="card-text">Cantidad de productos existentes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidad JS de Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            </div>
        </div>
    </div>

    @include('layouts.footer') 

</body>