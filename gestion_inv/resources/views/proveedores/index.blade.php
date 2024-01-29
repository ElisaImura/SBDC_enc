<head>
    <title>Easy System - Lista de Proveedores</title>
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
                <h1 class="titulo_principal text-center">Listado de Proveedores</h1>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('nuevoProveedor') }}" class="btn btn-primary">
                        Nuevo Proveedor
                    </a>
                </div>
                </form>
            
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>RUC</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->prove_id ?? 'NN'}}</td>
                            <td>{{ $proveedor->prove_nombre ?? 'NN' }}</td>
                            <td>{{ $proveedor->prove_ruc ?? 'NN'}}</td>

                        
                            <td style="width: 280px">
                                <form action="{{ route('proveedores.destroy', ['prove_id' => $proveedor->prove_id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                        Eliminar
                                    </button>
                                                     
                                <a href="{{ route('proveedores.edit', ['prove_id' => $proveedor->prove_id]) }}" class="btn btn-warning">
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