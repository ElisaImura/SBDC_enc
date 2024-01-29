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
                    <a href="{{ route('nuevoCliente') }}" class="btn btn-primary">
                        Nuevo Cliente
                    </a>
                </div>
                </form>
            
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
                                <form action="{{ route('clientes.destroy', ['cli_id' => $cliente->cli_id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                        Eliminar
                                    </button>
                                                     
                                <a href="{{ route('clientes.edit', ['cli_id' => $cliente->cli_id]) }}" class="btn btn-warning">
                                    Editar
                                </a>
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

</body>