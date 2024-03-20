<head>
    <title>Stocking - Login</title>
    @include('layouts.head')   
</head> 

<body>
    <div id="main-container" class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="container justify-content-center">          
            <div class="row justify-content-center">
                @if (session('error'))
                    <div class="alert alert-danger col-md-8">
                        {{session('error')}}
                    </div>
                @endif
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header Frojo-Lblanco">Login</div>

                        <div class="card-body">
                            <form method="POST" action="{{route('inicia-sesion') }}">
                                @csrf <!-- Campo CSRF -->
                                <div class="form-group">
                                    <label for="userInput">Nombre:</label>
                                    <input type="text" id="userInput" name="name" class="form-control" placeholder="Ingrese su contraseña" required autocomplete="disable">
                                </div>

                                <div class="form-group">
                                    <label for="passwordInput">Contraseña:</label>
                                    <input type="password" id="passwordInput" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btnAccion">Iniciar Sesion</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>