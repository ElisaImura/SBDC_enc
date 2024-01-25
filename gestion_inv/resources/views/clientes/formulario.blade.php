@include('layouts.head') 

@include('layouts.navbar') 

@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
<div id="viewport">
  @include('layouts.sidebar')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Cliente</div>
                    
                    <div class="card-body">
                      <form method="POST" action="/clientes/create">
                            @csrf <!-- Campo CSRF -->

                            <div class="form-group">
                                <label for="cli_nombre">Nombre:</label>
                                <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" value="{{old('cli_nombre')}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="cli_apellido">Apellido:</label>
                                <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" value="{{old('cli_apellido')}}">
                            </div>

                            <div class="form-group">
                                <label for="cli_ruc">RUC:</label>
                                <input type="text" name="cli_ruc" id="cli_ruc" class="form-control" value="{{old('cli_ruc')}}">
                            </div>

                            <div class="form-group">
                                <label for="cli_direccion">Direccion:</label>
                                <input type="text" name="cli_direccion" id="cli_direccion" class="form-control" value="{{old('cli_direccion')}}">
                            </div>
                            <div class="form-group">
                                <label for="cli_telefono">Telefono:</label>
                                <input type="number" name="cli_telefono" id="cli_telefono" class="form-control" value="{{old('prod_preciocosto')}}">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>