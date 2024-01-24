<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>


<div id="viewport">
  @include('layouts.sidebar')

    <div class="content container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Producto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.update', ['prod_id' => $producto->prod_id]) }}">
                            @csrf
                            @method('PUT') <!-- Cambiado a PUT -->

                            <div class="form-group">
                                <label for="prod_nombre">Nombre:</label>
                                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" value="{{ $producto->prod_nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="cat_id">Categoría:</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="{{ optional($producto->categoria)->cat_id }}" selected>{{ optional($producto->categoria)->cat_nombre }}</option>
                                    <!-- Aquí deberías tener opciones para todas las categorías disponibles -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="prod_descripcion">Descripcion:</label>
                                <input type="text" name="prod_descripcion" id="prod_descripcion" class="form-control" value="{{ $producto->prod_descripcion }}">
                            </div>

                            <div class="form-group">
                                <label for="prod_cant">Cantidad:</label>
                                <input type="number" name="prod_cant" id="prod_cant" class="form-control" value="{{ $producto->prod_cant }}">
                            </div>

                            <div class="form-group">
                                <label for="prod_precioventa">Precio Venta:</label>
                                <input type="number" name="prod_precioventa" id="prod_precioventa" class="form-control" value="{{ $producto->prod_precioventa }}">
                            </div>

                            <div class="form-group">
                                <label for="prod_preciocosto">Precio Costo:</label>
                                <input type="number" name="prod_preciocosto" id="prod_preciocosto" class="form-control" value="{{ $producto->prod_preciocosto }}">
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