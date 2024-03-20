<head>
    <title>Stocking - Editar Producto</title>
    @include('layouts.head') 
</head>

@include('layouts.navbar') 

<body>
    <div id="main-container">
      @include('layouts.sidebar')

        <div class="content">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header Frojo-Lblanco">Editar Producto</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('productos.update', ['prod_id' => $producto->prod_id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <input type="hidden" id="source" name="source" value="{{$source}}">
                                    <div class="form-group">
                                        <label for="prod_nombre">Nombre:</label>
                                        <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{ $producto->prod_nombre }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="cat_id">Categoría:</label>
                                        <select name="cat_id" id="cat_id" class="form-control" required>
                                            <option value="{{ optional($producto->categoria)->cat_id }}" selected>{{ optional($producto->categoria)->cat_nombre }}</option>
                                            <!-- Aquí deberías tener opciones para todas las categorías disponibles -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="prod_descripcion">Descripcion:</label>
                                        <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{ $producto->prod_descripcion }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="prod_imagen">Imagen:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="prod_imagen" name="prod_imagen">
                                            <label class="custom-file-label" for="prod_imagen">Seleccionar archivo</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btnAccion">Guardar</button>
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

    <script type="text/javascript">
        document.getElementById('prod_imagen').addEventListener('change', function(event) {
            const files = event.target.files; // Obtiene los archivos seleccionados
            if (files.length > 0) { // Verifica si se seleccionó al menos un archivo
                const file = files[0]; // Toma el primer archivo seleccionado
                console.log('Nombre del archivo:', file.name); // Muestra el nombre del archivo en la consola
                console.log('Tipo del archivo:', file.type); // Muestra el tipo del archivo en la consola
                console.log('Tamaño del archivo:', file.size, 'bytes'); // Muestra el tamaño del archivo en la consola
                // Actualiza la etiqueta del input con el nombre del archivo seleccionado
                var fileName = document.getElementById("prod_imagen").files[0].name;
                var label = document.querySelector('.custom-file-label');
                label.textContent = fileName;
            } else {
                console.log('No se seleccionó ningún archivo'); // Muestra un mensaje si no se seleccionó ningún archivo
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const fileName = "{{ $producto->prod_imagen ?? '' }}"; // Obtener el nombre de la imagen del producto
            const label = document.querySelector('.custom-file-label');

            if (fileName) {
                label.textContent = fileName; // Mostrar el nombre de la imagen en el label
            }
        });
    </script>

</body>