<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ventas</title>    
</head>
@include('layouts.head') 
<body>
  @include('layouts.navbar') 
  
<div id="viewport">
  @include('layouts.sidebar')

  

    <div class="content">

        
        <div class="container">

            

            <div class="mt-4 row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong>Nueva Venta</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('DetalleTemp.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="prod_id">Producto:</label>
                                    <select name="prod_id" id="categoria" class="form-control">
                                        <option value="opcion">Seleccione una Opción</option>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->precioventa }}">{{ $producto->prod_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="dventa_cant">Cantidad</label>
                                    <input type="number" class="form-control" name="dventa_cantidad" placeholder="Cantidad" required>
                                </div>
                                <div class="form-group">
                                    <label for="dventa_precio">Precio</label>
                                    <input type="number" class="form-control" name="dventa_precio" placeholder="Precio" required>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" class="form-control" name="total" placeholder="Total" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                        </div>
                    </div>

                    <div>
                        <form method="post" action="{{ route('ventas.create') }}">
                            <div class="form-group">
                                <label for="cli_id">Cliente:</label>
                                <select name="cli_id" id="cliente" class="form-control">
                                    <option value="opcion">Seleccione una Opción</option>
                                    @foreach($clientes as $cli_id => $cli_nombre)
                                        <option value="{{ $cli_id }}">{{ $cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Concretar Venta</button>
                        </form>
                      </div>
                </div>

                
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                        <th class="text-center" style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($venta_detalles as $dventa)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dventa->venta_id }}</td> <!-- Cambiado a venta_id -->
                                            <td>{{ $dventa->producto->prod_nombre }}</td>
                                            <td>{{ $dventa->dventa_cantidad }}</td>
                                            <td>{{ $dventa->dventa_precio }}</td>
                                            <td>Total</td>
                                            <td class="text-center">
                                                <!-- Puedes agregar acciones si es necesario -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoria').on('change', function() {
            var selectedProductPrice = $('option:selected', this).data('precio');

            // Actualiza el campo de precio con el precio del producto seleccionado
            $('input[name="dventa_precio"]').val(selectedProductPrice);
        });
    });
</script>




</body>
</html>
