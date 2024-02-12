<head>
    <title>Easy System - Crear Producto</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
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
                            <div class="card-header">Crear Producto</div>
                            
                            <div class="card-body">
                                <form method="POST" action="{{ route('productos.create') }}">
                                    @csrf <!-- Campo CSRF -->

                                    <div class="form-group">
                                        <label for="prod_nombre">Nombre:</label>
                                        <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{ old('prod_nombre') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="cat_id">Categoría:</label>
                                        <select name="cat_id" id="categoria" class="form-control">
                                            <option value="opcion">Seleccione una Opción</option>
                                            @foreach($categorias as $cat_id => $nombre)
                                                <option value="{{ $cat_id }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="prod_descripcion">Descripción:</label>
                                        <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{ old('prod_descripcion') }}">
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
