<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>

@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
<div id="viewport">
  @include('layouts.sidebar')
    
    <div class="content container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Producto</div>
                    
                    <div class="card-body">
                      <form method="POST" action="/productos/create">
                            @csrf <!-- Campo CSRF -->

                            <div class="form-group">
                                <label for="prod_nombre">Nombre:</label>
                                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{old('prod_nombre')}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="cat_id">Categoría:</label>
                                <select name="cat_id" id="categoria" class="form-control">
                                    <option value="opcion">Seleccione una Opción</option>
                                    @foreach($categorias as $cat_id => $nombre)
                                        <option value="{{ $cat_id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="prod_descripcion">Descripción:</label>
                                <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{old('prod_descripcion')}}">
                            </div>

                            <div class="form-group">
                                <label for="prod_cant">Cantidad:</label>
                                <input type="text" name="prod_cant" id="prod_cant" class="form-control" value="{{old('prod_cant')}}">
                            </div>

                            <div class="form-group">
                                <label for="prod_precioventa">Precio Venta:</label>
                                <input type="number" name="prod_precioventa" id="prod_precioventa" class="form-control" value="{{old('prod_precioventa')}}">
                            </div>
                            <div class="form-group">
                                <label for="prod_preciocosto">Precio Compra:</label>
                                <input type="number" name="prod_preciocosto" id="prod_preciocosto" class="form-control" value="{{old('prod_preciocosto')}}">
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