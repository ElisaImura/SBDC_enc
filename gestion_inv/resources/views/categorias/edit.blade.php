<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    @include('layouts.head') 
</head>

@include('layouts.navbar')

<body> 
    <div id="main-container">
      @include('layouts.sidebar')

        <div class="content">
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
        </div>
    </div>

    @include('layouts.footer') 

</body>