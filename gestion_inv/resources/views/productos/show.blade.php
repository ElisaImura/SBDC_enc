<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario</div>
                    
                    <div class="card-body">
                      <form  method="post" action="{{route('productos.update',['prod_id'=>$producto->prod_id])}}">
                            @csrf <!-- Campo CSRF -->
                           
                            <div class="form-group">
                                <label for="prod_nombre">Nombre:</label>
                                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{$producto->prod_nombre}}"disabled="true">
                            </div>

                            <div class="form-group">
                                <label for="cat_id">Categoría:</label>
                                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{ optional($producto->categoria)->cat_nombre }}"disabled="true">
                                
                            </div>
                            
                            

                            <div class="form-group">
                                <label for="prod_descripcion">Descripcion:</label>
                                <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{$producto->prod_descripcion}}" disabled="true">
                            </div>

                            <div class="form-group">
                                <label for="prod_cant">Cantidad:</label>
                                <input type="number" name="prod_cant" id="prod_cant" class="form-control" value="{{$producto->prod_cant}}"disabled="true">
                            </div>

                            <div class="form-group">
                                <label for="prod_precioventa">Precio Venta:</label>
                                <input type="number" name="prod_precioventa" id="prod_precioventa" class="form-control" value="{{$producto->prod_precioventa}}"disabled="true">
                            </div>

                            <div class="form-group">
                                <label for="prod_preciocosto">Precio Costo:</label>
                                <input type="number" name="prod_preciocosto" id="prod_preciocosto" class="form-control" value="{{$producto->prod_preciocosto}}"disabled="true">
                            </div>

                        </form>
                        <div class="form-group">
                            <button onclick="goBack()" class="btn btn-primary">Volver</button>
                        </div>

                        <script>
                            function goBack() {
                                window.history.back();
                            }
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

