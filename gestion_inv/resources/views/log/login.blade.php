<head>
    <title>Easy System</title>
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
                        <div class="card-header">Login</div>

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
                                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>