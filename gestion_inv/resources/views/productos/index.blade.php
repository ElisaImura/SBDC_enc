<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>

<div id="viewport">
  @include('layouts.sidebar')

  <!-- Content -->
    <div id="content">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-center">Listado de Productos</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('nuevo') }}" class="btn btn-primary">
                    Nuevo Producto
                </a>
            </div>

            <table class="table table-bordered table-striped" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Precio Compra</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->prod_id ?? 'NN' }}</td>
                            <td>{{ $producto->categoria->cat_nombre ?? 'NN' }}</td>
                            <td>{{ $producto->prod_nombre ?? 'NN' }}</td>
                            <td>{{ $producto->prod_descripcion ?? 'NN' }}</td>
                            <td>{{ $producto->prod_cant ?? 'NN' }}</td>
                            <td>{{ $producto->prod_precioventa ?? 'NN' }}</td>
                            <td>{{ $producto->prod_preciocosto ?? 'NN' }}</td>
                            <td style="width: 280px">
                              <a href="{{ route('productos.destroy', ['prod_id' => $producto->prod_id]) }}"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');"
                                class="btn btn-danger">
                                Eliminar
                             </a>
                             
                                <a href="{{ route('productos.edit', ['prod_id' => $producto->prod_id]) }}" class="btn btn-warning">
                                    Editar
                                </a>
                                <a href="{{ route('productos.show', ['prod_id' => $producto->prod_id]) }}" class="btn btn-info">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>



