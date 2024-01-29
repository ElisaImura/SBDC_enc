<head>
    <title>Easy System - Editar Proveedor</title>
    @include('layouts.head') 
</head>

@include('layouts.navbar') 

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif

    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">
                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edicion de Proveedores</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('proveedores.update', ['prove_id' => $proveedor->prove_id]) }}">
                                    @method('PUT') <!-- Especificar el método PUT -->
                                    @csrf <!-- Campo CSRF -->

                                    <div class="form-group">
                                        <label for="prove_nombre">Nombre:</label>
                                        <input type="text" name="prove_nombre" id="prove_nombre" class="form-control" value="{{$proveedor->prove_nombre}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="prove_ruc">RUC:</label>
                                        <input type="text" name="prove_ruc" id="prove_ruc" class="form-control" value="{{$proveedor->prove_ruc}}" required>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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