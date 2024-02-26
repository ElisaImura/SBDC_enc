<head>
    <title>Easy System - Lista de Clientes</title>
    @include('layouts.head')   
</head> 

@include('layouts.navbar') 

<body>
    <div id="main-container">
        @include('layouts.sidebar') 

        <div class="content">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <h1 class="titulo_principal text-center">Listado de Clientes</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('nuevoCliente') }}" class="btn btn-primary">Nuevo Cliente</a>
                </div>
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>RUC</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cli_id ?? 'NN'}}</td>
                            <td>{{ $cliente->cli_nombre ?? 'NN' }}</td>
                            <td>{{ $cliente->cli_apellido ?? 'NN' }}</td>
                            <td>{{ $cliente->cli_ruc ?? 'NN'}}</td>
                            <td>{{ $cliente->cli_direccion ?? 'NN'}}</td>
                            <td>{{ $cliente->cli_telefono ?? 'NN' }}</td>
                            <td style="width: 280px">
                                <form action="{{ route('clientes.destroy', ['cli_id' => $cliente->cli_id])}}" method="POST" id="formEliminarCliente-{{ $cliente->cli_id }}" data-id="{{ $cliente->cli_id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <a href="{{ route('clientes.edit', ['cli_id' => $cliente->cli_id]) }}" class="btn btn-warning">Editar</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @include('layouts.footer') 

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var formsEliminar = document.querySelectorAll('form[id^="formEliminarCliente-"]');

            formsEliminar.forEach(function(formEliminar) {
                var btnEliminarVenta = formEliminar.querySelector('button[type="submit"]');
                
                btnEliminarVenta.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita el envío del formulario por defecto
                    
                    var formulario = event.target.closest('form');
                    var id = formulario.dataset.id;
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de forma asincrónica
                            $.ajax({
                                url: formulario.action,
                                method: 'POST',
                                data: $(formulario).serialize(),
                                success: function(response) {
                                    // Manejar la respuesta, por ejemplo, recargar la página
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    // Manejar el error, si es necesario
                                    console.error(error);
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
