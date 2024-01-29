<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Categorías</title>    
</head>
@include('layouts.head') 
<body>
  @include('layouts.navbar') 
  
<div id="viewport">
  @include('layouts.sidebar')

    <div class="content">
        <div class="container">
            <h1 class="titulo_principal text-center">Categorías</h1>

            <div class="mt-4 row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong>Agregar Categoría</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('ventas.create') }}">
                                @csrf
                              
                                <div class="form-group">
                                    <label for="prod_id">Categoría:</label>
                                    <select name="prod_id" id="categoria" class="form-control">
                                        <option value="opcion">Seleccione una Opción</option>
                                        @foreach($productos as $prod_id => $prod_nombre)
                                            <option value="{{ $prod_id }}">{{ $prod_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dventa_cant">Cantidad</label>
                                    <input type="number" class="form-control" name="dventa_cant" placeholder="Nombre de la categoría" required>
                                </div>
                                <div class="form-group">
                                    <label for="dventa_precio">Precio</label>
                                    <input type="number" class="form-control" name="dventa_precio" placeholder="Nombre de la categoría" required>
                                </div>
                                <div class="form-group">
                                    <label for="dventa_iva">IVA</label>
                                    <input type="number" class="form-control" name="dventa_iva" placeholder="Nombre de la categoría" required>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" class="form-control" name="total" placeholder="Nombre de la categoría" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                            </form>
                        </div>
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
                                    @foreach ($detalle_venta as $dventa)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $detalle_venta->cliente->cli_nombre }}</td>
                                            <td>{{ $detalle_venta->producto->prod_nombre }}</td>
                                            <td>{{ $detalle_venta->dventa_precio }}</td>
                                            <td>{{ $detalle_venta->dventa_cant }}</td>
                                            <td>Total</td>
                                            <td class="text-center">
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

</body>
</html>
