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
                    <div class="card-header">Crear Proveedor</div>
                    
                    <div class="card-body">
                      <form method="POST" action="/proveedores/create">
                            @csrf <!-- Campo CSRF -->

                            <div class="form-group">
                                <label for="prove_nombre">Nombre:</label>
                                <input type="text" name="prove_nombre" id="prove_nombre" class="form-control" value="{{old('prove_nombre')}}">
                            </div>
                            

                            <div class="form-group">
                                <label for="prove_ruc">RUC:</label>
                                <input type="text" name="prove_ruc" id="prove_ruc" class="form-control" value="{{old('prove_ruc')}}">
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