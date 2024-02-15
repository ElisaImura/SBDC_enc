<head>
    <title>Easy System - Editar Producto</title>
    @include('layouts.head') 
</head>

@include('layouts.navbar') 

<body>
    <div id="main-container">
      @include('layouts.sidebar')

        <div class="content">
            <div class="container">
                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Editar Producto</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('productos.update', ['prod_id' => $producto->prod_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <input type="hidden" id="source" name="source" value="{{$source}}">
                                    <div class="form-group">
                                        <label for="prod_nombre">Nombre:</label>
                                        <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{ $producto->prod_nombre }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="cat_id">Categoría:</label>
                                        <select name="cat_id" id="cat_id" class="form-control">
                                            <option value="{{ optional($producto->categoria)->cat_id }}" selected>{{ optional($producto->categoria)->cat_nombre }}</option>
                                            <!-- Aquí deberías tener opciones para todas las categorías disponibles -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="prod_descripcion">Descripcion:</label>
                                        <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{ $producto->prod_descripcion }}">
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