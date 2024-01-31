<head>
    <title>Easy System</title>
    @include('layouts.head')   
</head> 
<body>

    <div id="main-container" class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="mb-4">Bienvenido a Easy System</h1>
                    <a class="btn btn-primary" href="{{ route('login') }}">Ingresar al Sistema</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
