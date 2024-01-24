<link rel="stylesheet" type="text/css" href="{{asset('css/estilos.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/sidebar.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/jsdelivr.js')}}"></script>

<div class="sidebar">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <a href="{{ route('categorias.index') }}" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Clientes
        </a>        
      </li>
      <li class="mb-1">
        <a href="{{ route('categorias.index') }}" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Categorías
        </a>        
      </li>
      <li class="mb-1">
        <a href="{{ route('productos.index') }}" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Productos
        </a>
      </li>
      <li class="mb-1">
        <a href="/" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Ventas
        </a>
      </li>
      <li class="mb-1">
        <a href="/" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Reportes
        </a>
      </li>
      <li class="mb-1">
        <a href="/" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Presupuestos
        </a>
      </li>
      <li class="mb-1">
        <a href="/" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Media
        </a>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <a href="/" class="btn btn-toggle d-flex align-items-center rounded collapsed link-dark text-decoration-none">
          Cuenta
        </a>
      </li>
    </ul>
</div>
