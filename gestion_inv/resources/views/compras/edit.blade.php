<head>
    <title>Easy System - Editar Producto</title>
    @include('layouts.head') 
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@include('layouts.navbar') 

<body>
    <div id="main-container">
        @include('layouts.sidebar')

        <div class="content">
            <div class="container">

                <div id="form" class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Editar Venta</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('compras.update', ['temp_id' => $temp_compra_detalles->temp_id]) }}">
                                    @csrf
                                    @method('PUT') <!-- Cambiado a PUT -->
                                    <div class="form-group">
                                        <label for="prod_id">Producto:</label>
                                        <select name="prod_id" id="prod_id" class="form-control">
                                            @foreach($productos as $producto)
                                                <option value="{{ $producto->prod_id }}" data-precio="{{ $producto->prod_precioventa }}" data-cantidad="{{$producto->prod_cant}}" {{ $producto->prod_id == optional($temp_compra_detalles->producto)->prod_id ? 'selected' : '' }}>
                                                    {{ $producto->prod_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dcompra_cantidad">Cantidad:</label>
                                        <input type="number" name="dcompra_cantidad" id="dcompra_cantidad" class="form-control" value="{{ $temp_compra_detalles->dcompra_cantidad }}" required>
                                    </div>

                                    <input type="hidden" name="pcompra" id="pcompra" value="">
                                    <div class="form-group">
                                        <label for="dcompra_pcompra">Precio Compra</label>
                                        <input type="number" class="form-control" name="dcompra_pcompra" id="dcompra_pcompra" placeholder="Precio Compra" value="{{ $temp_compra_detalles->dcompra_pcompra }}" required>
                                    </div>
                                    <input type="hidden" name="pventa" id="pventa" value="">
                                    <div class="form-group">
                                        <label for="dcompra_pventa">Precio Venta</label>
                                        <input type="number" class="form-control" name="dcompra_pventa" id="dcompra_pventa" placeholder="Precio Venta" value="{{ $temp_compra_detalles->dcompra_pventa }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="botonEnviar" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Manejar el cambio en la selección del producto
            $('#prod_id').change(function () {
                // Obtener el valor seleccionado
                var selectedProductId = $(this).val();

                if (selectedProductId !== 'opcion') {
                    // Obtener el precio del producto desde el atributo data-precio
                    var selectedProductPrice = $('option:selected', this).data('precio');
                    // Establecer el precio en el campo de entrada
                    $('#dcompra_precio').val(selectedProductPrice);
                    // Actualizar el campo oculto de precio si es necesario
                    $('#precio').val(selectedProductPrice);
                    // Calcular el total cuando cambia el producto (precio y cantidad)
                    calcularTotal();
                } else {
                    // Limpiar el campo de precio si la opción seleccionada es "Seleccione una Opción"
                    $('#dcompra_precio').val('');
                    $('#precio').val('');
                    // Limpiar el campo de total
                    $('#total').val('');
                }
            });

            // Manejar el cambio en el precio
            $('#dcompra_precio').change(function() {
                // Calcular el total cuando cambia el precio
                calcularTotal();
            });

        });
    </script>

    @include('layouts.footer') 
</body>
