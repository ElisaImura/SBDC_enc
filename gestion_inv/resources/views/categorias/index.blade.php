<head>
    <title>Stocking - Lista de Categorías</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar')

<body>

    <div id="main-container">
      @include('layouts.sidebar')

        <div class="content">
            <div class="container tablas vista">
                <h1 class="titulo_principal text-center">Categorías</h1>
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
                <div class="mt-4 row">
                    <div id="aggCat" class="col-md-5">
                        <div class="card">
                            <div class="card-header Frojo-Lblanco">
                                <strong>Agregar Categoría</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('categorias.create') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cat_nombre">Nombre de la categoría:</label>
                                        <input type="text" class="form-control" name="cat_nombre" placeholder="Nombre de la categoría" required>
                                    </div>
                                    <button type="submit" class="btn btnAccion">Agregar Categoría</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header Frojo-Lblanco">
                                <strong>Lista de Categorías</strong>
                            </div>
                            <div class="card-body" style="padding: 0px;">
                                <table class="table border-all-black table-hover" style="margin: 0px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">Nº</th>
                                            <th>Categorías</th>
                                            <th class="text-center" style="width: 100px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $cat)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $cat->cat_nombre }}</td>
                                                <td id="btn-cat" class="text-center botones" >
                                                    <div class="row justify-content-center">
                                                        <div class="col-4 col-btn align-middle">
                                                            <form action="{{ route('categorias.destroy', $cat->cat_id) }}" method="POST" id="formEliminarCategoria-{{ $cat->cat_id }}" data-id="{{ $cat->cat_id }}" style="margin: 0px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btnEliminar btnEliminarCategoria">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-4 col-btn">
                                                            <a href="{{ route('categorias.edit', $cat->cat_id) }}" class="btn btnEditar">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
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

    @include('layouts.footer') 

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.btnEliminarCategoria').click(function() {
                var formulario = $(this).closest('form');
                var id = formulario.data('id');
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
                        // Envía el formulario para eliminar la venta
                        formulario.submit();
                    }
                });
            });
        });
    </script>
</body>
