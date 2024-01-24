<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div style="background-color:rgb(4, 141, 141);" class="card-header">Formulario de Edicion de Cliente</div>
                    
                    <div class="card-body">
                      <form  method="post" action="{{route('actualizar',['id'=>$clientes->id])}}">
                            @csrf <!-- Campo CSRF -->
                           
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{$clientes->nombre}}" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" value="{{$clientes->apellido}}"  required>
                            </div>

                            <div class="form-group">
                                <label for="edad">Edad:</label>
                                <input type="number" name="edad" id="edad" class="form-control" value="{{$clientes->edad}}" required>
                            </div>

                            <div class="form-group">
                                <label for="ci">CI:</label>
                                <input type="text" name="ci" id="ci" class="form-control" value="{{$clientes->ci}}" required>
                            </div>

                            <div class="form-group">
                                <label for="correo">Correo Electrónico:</label>
                                <input type="email" name="correo" id="correo" class="form-control" value="{{$clientes->correo}}" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha_nac">Fecha de Nacimiento:</label>
                                <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" value="{{$clientes->fecha_nac}}"required>
                            </div>

                           <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="Activo" {{ $clientes->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $clientes->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
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

