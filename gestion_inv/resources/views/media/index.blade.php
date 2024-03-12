<head>
    <title>Media de Productos</title>
    @include('layouts.head')
</head>

@include('layouts.navbar')

<body>

    <!-- Main Container -->
    <div id="main-container">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content -->
        <div class="content vista">
            <div class="container">
                <h1 class="text-center mb-4">Biblioteca de Media</h1>
                <form action="{{ route('media.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar producto" name="search">
                        <button class="btn btnAccion" type="submit">Buscar</button>
                    </div>
                </form>
                @if ($productos->isEmpty())
                    <p>No se encontraron productos que coincidan con la búsqueda.</p>
                @else
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($productos as $producto)
                        <div class="col col-md-4">
                            <div class="card cartas">
                                @if($producto->prod_imagen) <!-- Verifica si el producto tiene una imagen -->
                                    @if(file_exists(public_path('image/' . $producto->prod_imagen))) <!-- Verifica si el archivo de imagen existe -->
                                        <div class="img-container">
                                            <!-- Si el archivo de imagen existe, muestra la etiqueta <img> con la URL de la imagen -->
                                            <img src="{{ asset('image/' . $producto->prod_imagen) }}" class="card-img-top fixed-img" alt="{{ $producto->prod_nombre }}">
                                        </div>
                                    @else
                                        <!-- Si el archivo de imagen no existe, muestra el mensaje "Not found" -->
                                        <div class="no-media">
                                            <span>Not found</span>
                                        </div>
                                    @endif
                                @else
                                    <!-- Si el producto no tiene imagen, muestra el mensaje "No media" -->
                                    <div class="no-media">
                                        <span>No media</span>
                                    </div>
                                @endif
                                <div id="card-media" class="card-body">
                                    <h5 class="card-title">{{ $producto->prod_nombre }}</h5>
                                    <div class="row justify-content-between">
                                        <div class="col-7">
                                            <p class="card-text">{{ $producto->prod_descripcion }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text"><strong>Stock: </strong>{{ $producto->prod_cant }}</p>
                                        </div>
                                    </div>
                                </div>
                                <form id="editar-media" action="{{ route('productos.edit', ['prod_id' => $producto->prod_id]) }}">
                                @csrf <!-- Agrega el token CSRF para proteger el formulario -->
                                <input type="hidden" id="source" name="source" value="media"> <!-- Campo oculto para enviar la variable 'source' -->
                                <button id="btnEditarMedia" class="btn btn-block mt-auto">
                                    Editar 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg>
                                </button>
                            </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
