<head>
    <title>Easy System - Lista de Productos</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>

    <div id="main-container">
      @include('layouts.sidebar') 

      <!-- Content -->
      <div class="content tablas">
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
                    <a href="{{ route('nuevoProducto') }}" class="btn btnAccion">Agregar Producto</a>
                </div>

                <table class="table table-bordered" style="text-align: center;">
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
                                            <button type="button" class="btn btnAccion btnEliminarProducto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                            <a href="{{ route('productos.edit', ['prod_id' => $producto->prod_id]) }}" class="btn btnAccion">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                </svg>
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
                            formulario.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
