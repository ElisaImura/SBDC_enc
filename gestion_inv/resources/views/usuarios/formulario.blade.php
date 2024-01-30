<head>
    <title>Easy System - Crear Usuario</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
    @endif

    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">
                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-header">Crear Usuario</div>
                            
                            <div class="card-body">
                                <form method="POST" action="{{ route('login.auth') }}">
                                    @csrf <!-- Campo CSRF -->
                                    <div class="form-group">
                                        <label for="usu_nombre">Usuario:</label>
                                        <input type="text" id="usu_nombre" name="usu_nombre" class="form-control"
                                            placeholder="Ingrese su nombre de usuario">
                                    </div>

                                    <div class="form-group">
                                        <label for="usu_contra">Contraseña:</label>
                                        <input type="password" id="usu_contra" name="usu_contra" class="form-control" placeholder="Ingrese su contraseña">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
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
    
</body>