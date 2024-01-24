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
                            <form method="post" action="{{ route('categorias.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="cat_nombre">Nombre de la categoría:</label>
                                    <input type="text" class="form-control" name="cat_nombre" placeholder="Nombre de la categoría" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <strong>Lista de Categorías</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Categorías</th>
                                        <th class="text-center" style="width: 100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $cat)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $cat->cat_nombre }}</td>
                                            <td class="text-center">

                                                
                                                <form action="{{ route('categorias.destroy', $cat->cat_id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                                        <span class="glyphicon glyphicon-trash"></span> Eliminar
                                                    </button>
                                                    <a href="{{ route('categorias.edit', $cat->cat_id) }}" class="btn btn-warning btn-sm" title="Editar">
                                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                                    </a>
                                                </form>
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
