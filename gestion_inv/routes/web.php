<?php

use App\Models\Venta_detalle;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', "log.inicio")->name('inicio');


//Login Controller
Route::view('/login', "log.login")->name('login');
Route::view('/registro', "log.register")->name('registro');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//CategoriaController
Route::get('/categorias', [CategoriaController::class, 'index'])->middleware('auth')->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->middleware('auth')->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->middleware('auth')->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->middleware('auth')->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->middleware('auth')->name('categorias.destroy');
Route::post('/categorias/create', [CategoriaController::class, 'create'])->middleware('auth')->name('categorias.create');


// Productos Controller
Route::get('/productos', [ProductoController::class, 'index'])->middleware('auth')->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->middleware('auth')->name('productos.store');
Route::get('/productos/{prod_id}/edit', [ProductoController::class, 'edit'])->middleware('auth')->name('productos.edit');
Route::put('/productos/{prod_id}', [ProductoController::class, 'update'])->middleware('auth')->name('productos.update');
Route::delete('/productos/{prod_id}', [ProductoController::class, 'destroy'])->middleware('auth')->name('productos.destroy');
Route::post('/productos/create', [ProductoController::class, 'create'])->middleware('auth')->name('productos.create');
Route::get('/productos/formulario',[ProductoController::class,'formulario'])->middleware('auth')->name('nuevoProducto'); 

// Cliente Controller
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth')->name('clientes.index');
Route::post('/clientes', [ClienteController::class, 'store'])->middleware('auth')->name('clientes.store');
Route::get('/clientes/{cli_id}/edit', [ClienteController::class, 'edit'])->middleware('auth')->name('clientes.edit');
Route::put('/clientes/{cli_id}', [ClienteController::class, 'update'])->middleware('auth')->name('clientes.update');
Route::delete('/clientes/{cli_id}', [ClienteController::class, 'destroy'])->middleware('auth')->name('clientes.destroy');
Route::post('/clientes/create', [ClienteController::class, 'create'])->middleware('auth')->name('clientes.create');
Route::get('/clientes/formulario',[ClienteController::class,'formulario'])->middleware('auth')->name('nuevoCliente'); 

// Proveedor Controller
Route::get('/proveedores', [ProveedorController::class, 'index'])->middleware('auth')->name('proveedores.index');
Route::post('/proveedores', [ProveedorController::class, 'store'])->middleware('auth')->name('proveedores.store');
Route::get('/proveedores/{prove_id}/edit', [ProveedorController::class, 'edit'])->middleware('auth')->name('proveedores.edit');
Route::put('/proveedores/{prove_id}', [ProveedorController::class, 'update'])->middleware('auth')->name('proveedores.update');
Route::delete('/proveedores/{prove_id}', [ProveedorController::class, 'destroy'])->middleware('auth')->name('proveedores.destroy');
Route::post('/proveedores/create', [ProveedorController::class, 'create'])->middleware('auth')->name('proveedores.create');
Route::get('/proveedores/formulario',[ProveedorController::class,'formulario'])->middleware('auth')->name('nuevoProveedor'); 


//Ventas detalle Controller
Route::get('/ventas', [VentaController::class, 'index'])->middleware('auth')->name('ventas.index');
Route::get('/crear-tabla-temporal', [VentaController::class, 'createTempTable'])->middleware('auth')->name('tablatemp.create');
Route::post('/ventasDetTemp/create', [VentaController::class, 'createDetalleTemp'])->middleware('auth')->name('DetalleTemp.create');
Route::delete('/ventas/{temp_id}', [VentaController::class, 'destroy'])->middleware('auth')->name('ventas.destroy');
Route::get('/ventas/{temp_id}/edit', [VentaController::class, 'edit'])->middleware('auth')->name('ventas.edit');
Route::put('/ventas/{temp_id}', [VentaController::class, 'update'])->middleware('auth')->name('ventas.update');
Route::get('/obtener-precio-producto/{prod_id}', [VentaController::class, 'obtenerPrecioProducto']);
Route::post('/ventas/concretarVenta', [VentaController::class, 'concretarVenta'])->middleware('auth')->name('ventas.concretarVenta');
Route::post('/ventas/crearCliente', [VentaController::class, 'crearCliente'])->middleware('auth')->name('ventas.crearCliente');
Route::get('/verificar-producto/{prod_id}', [VentaController::class, 'verificarProducto'])->middleware('auth');


//Compra Controller
Route::get('/compras', [CompraController::class, 'index'])->middleware('auth')->name('compras.index');
Route::get('/crear-tabla-temporal', [CompraController::class, 'createTempTable'])->middleware('auth')->name('tablatemp.create');
Route::post('/comprasDetTemp/create', [CompraController::class, 'createDetalleTemp'])->middleware('auth')->name('DetalleTempCompra.create');
Route::post('/compras/concretarCompra', [CompraController::class, 'concretarCompra'])->middleware('auth')->name('compras.concretarCompra');
Route::delete('/compras/{temp_id}', [CompraController::class, 'destroy'])->middleware('auth')->name('compras.destroy');
Route::get('/compras/{temp_id}/edit', [CompraController::class, 'edit'])->middleware('auth')->name('compras.edit');
Route::put('/compras/{temp_id}', [CompraController::class, 'update'])->middleware('auth')->name('compras.update');
Route::get('/verificar-producto/{prod_id}', [CompraController::class, 'verificarProducto'])->middleware('auth');

//Presupuesto Controller
Route::get('/presupuesto', [PresupuestoController::class, 'index'])->middleware('auth')->name('presupuesto.index');
Route::get('/presupuesto-crear-tabla-temporal', [PresupuestoController::class, 'createTempTable'])->middleware('auth')->name('tablatemp.create');
Route::post('/presupuestoDetTemp/create', [PresupuestoController::class, 'createDetalleTemp'])->middleware('auth')->name('PresupuestoDetalleTemp.create');
Route::delete('/presupuesto/{temp_id}', [PresupuestoController::class, 'destroy'])->middleware('auth')->name('presupuesto.destroy');
Route::get('/presupuesto/{temp_id}/edit', [PresupuestoController::class, 'edit'])->middleware('auth')->name('presupuesto.edit');
Route::put('/presupuesto/{temp_id}', [PresupuestoController::class, 'update'])->middleware('auth')->name('presupuesto.update');
Route::get('/presupuesto-obtener-precio-producto/{prod_id}', [PresupuestoController::class, 'PresupuestoObtenerPrecioProducto']);
Route::post('/presupuesto/reiniciar', [PresupuestoController::class, 'reiniciar'])->middleware('auth')->name('presupuesto.reiniciar');
Route::post('/presupuesto/crearCliente', [PresupuestoController::class, 'crearCliente'])->middleware('auth')->name('presupuesto.crearCliente');
Route::get('/presupuesto-verificar-producto/{prod_id}', [PresupuestoController::class, 'verificarProducto'])->middleware('auth');
Route::post('/presupuesto/pdf', [PresupuestoController::class, 'generarPDF'])->middleware('auth')->name('presupuesto.generarPDF');