<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;

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

Route::get('/', function () {
    return view('layouts.sidebar');
});

//CategoriaController
// Categoría Controller
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::post('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');


// Productos Controller
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{prod_id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{prod_id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{prod_id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::post('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::get('/productos/formulario',[ProductoController::class,'formulario'])->name('nuevoProducto'); 

// Cliente Controller
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cli_id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cli_id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cli_id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::post('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::get('/clientes/formulario',[ClienteController::class,'formulario'])->name('nuevoCliente'); 
