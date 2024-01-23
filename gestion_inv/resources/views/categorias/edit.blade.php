<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <strong>Editar Categoría</strong>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('categorias.update', $categoria->cat_id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="cat_nombre">Nombre de la categoría</label>
                    <input type="text" class="form-control" name="cat_nombre" value="{{ $categoria->cat_nombre }}" required>

                </div>
                <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
