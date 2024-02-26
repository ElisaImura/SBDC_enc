<head>
    <title>Easy System - Lista de Productos</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>

    <div id="main-container">
      @include('layouts.sidebar') 

      <!-- Content -->
      <div class="content">
            <div class="container mt-4">
                <h1 class="titulo_principal text-center">Listado de Productos</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('nuevoProducto') }}" class="btn btn-primary">Agregar Producto</a>
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
                                    <div id="btn-pro" class="botones">
                                        <form action="{{ route('productos.destroy', ['prod_id' => $producto->prod_id]) }}" method="POST" id="formEliminarProducto-{{ $producto->prod_id }}" data-id="{{ $producto->prod_id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btnEliminarProducto">
                                                Eliminar
                                            </button>
                                            <a href="{{ route('productos.edit', ['prod_id' => $producto->prod_id]) }}" class="btn btn-warning">
                                                Editar
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer') 

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var formsEliminar = document.querySelectorAll('form[id^="formEliminarProducto-"]');

            formsEliminar.forEach(function(formEliminar) {
                var btnEliminarProducto = formEliminar.querySelector('.btnEliminarProducto');
                
                btnEliminarProducto.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita el envío del formulario por defecto
                    
                    var formulario = event.target.closest('form');
                    var id = formulario.dataset.id;
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de forma asincrónica
                            $.ajax({
                                url: formulario.action,
                                method: 'POST',
                                data: $(formulario).serialize(),
                                success: function(response) {
                                    // Manejar la respuesta, por ejemplo, recargar la página
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    // Manejar el error, si es necesario
                                    console.error(error);
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
