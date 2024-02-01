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
                            <div class="card-header">Editar Venta</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('ventas.update', ['temp_id' => $temp_venta_detalles->temp_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->

                                    <div class="form-group">
                                        <label for="prod_id">Producto:</label>
                                        <select name="prod_id" id="prod_id" class="form-control">
<<<<<<< HEAD
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->prod_id }}" {{ $producto->prod_id == $temp_venta_detalles->prod_id ? 'selected' : '' }}>
                                                    {{ $producto->prod_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
=======
                                            <option value="{{ optional($temp_venta_detalles->prod_id)->prod_id }}" selected>{{ optional($temp_venta_detalles->producto)->prod_nombre }}</option>
                                            <!-- Aquí deberías tener opciones para todas las categorías disponibles -->
                                        </select>
                                    </div>

>>>>>>> 6952c1ef57ee2535143452c8d715d78234d64768
                                    <div class="form-group">
                                        <label for="dventa_cantidad">Cantidad:</label>
                                        <input type="number" name="dventa_cantidad" id="dventa_cantidad" class="form-control" value="{{ $temp_venta_detalles->dventa_cantidad }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="dventa_precio">Precio :</label>
                                        <input type="number" name="dventa_precio" id="dventa_precio" class="form-control" value="{{ $temp_venta_detalles->dventa_precio }}">
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