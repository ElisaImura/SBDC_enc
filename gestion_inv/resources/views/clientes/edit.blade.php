<head>
    <title>Stocking - Editar Cliente</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>
    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header Frojo-Lblanco">Edicion de Cliente</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('clientes.update', ['cli_id' => $cliente->cli_id]) }}">
                                    @method('PUT') <!-- Especificar el método PUT -->
                                    @csrf <!-- Campo CSRF -->

                                    <div class="form-group">
                                        <label for="cli_nombre">Nombre:</label>
                                        <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" value="{{$cliente->cli_nombre}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cli_apellido">Apellido:</label>
                                        <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" value="{{$cliente->cli_apellido}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cli_ruc">RUC:</label>
                                        <input type="text" name="cli_ruc" id="cli_ruc" class="form-control" value="{{$cliente->cli_ruc}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cli_direccion">Direccion:</label>
                                        <input type="text" name="cli_direccion" id="cli_direccion" class="form-control" value="{{$cliente->cli_direccion}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cli_telefono">Telefono:</label>
                                        <input type="text" name="cli_telefono" id="cli_telefono" class="form-control" value="{{$cliente->cli_telefono}}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btnAccion">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer') 

</body>