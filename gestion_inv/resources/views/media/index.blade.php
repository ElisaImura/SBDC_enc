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
            <div class="container mt-5">
                <h1 class="text-center titulo">Biblioteca de Media</h1>
                <form action="{{ route('productos.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar producto" name="search">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </form>
                @if ($productos->isEmpty())
                    <p>No se encontraron productos que coincidan con la búsqueda.</p>
                @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($productos as $producto)
                    <div class="col col-md-4">
                        <div class="card cartas">
                            @if($producto->prod_imagen)
                            <div class="img-container">
                                <img src="{{ asset('image/' . $producto->prod_imagen) }}" class="card-img-top fixed-img" alt="{{ $producto->prod_nombre }}">
                            </div>
                            @else
                            <div class="no-media">
                                <span>No media</span>
                            </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->prod_nombre }}</h5>
                                <p class="card-text">{{ $producto->prod_descripcion }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <style>
        .fixed-img {
            width: 230px;
            height: 300px;
            object-fit: cover;
        }

        .img-container {
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .no-media {
            width: 100%;
            height: 300px; /* Altura por defecto */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .no-media span {
            font-size: 24px;
            color: #ccc;
        }

        .cartas{
            margin-top: 30px;
        }

        .titulo{
            margin: 0;
        }
    </style>
</body>
</html>
