<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all(); // Obtén todos los productos
        return view('productos.index', compact('productos'));
    }

    public function create(Request $request)
    {
        // Validación de entrada
        $rules = [
            'prod_nombre' => 'required',
            'prod_descripcion' => 'required',
            'prod_cant' => 'required',
            'prod_precioventa' => 'required',
            'prod_preciocosto' => 'required',
            //'cat_id' => 'required|exists:categorias,cat_id',
        ];
    
        $mensaje = [
            'required' => 'El :attribute campo es requerido',
            //'exists' => 'La categoría seleccionada no es válida',
        ];
    
        $this->validate($request, $rules, $mensaje);
    
        // Obtenemos el cat_id del request después de la validació
    
        // Verificamos si la categoría existe
    
        // Crear nuevo producto
        Producto::create([
            'prod_nombre' => $request->input('prod_nombre'),
            'prod_descripcion' => $request->input('prod_descripcion'),
            'prod_cant' => $request->input('prod_cant'),
            'prod_precioventa' => $request->input('prod_precioventa'),
            'prod_preciocosto' => $request->input('prod_preciocosto'),
            'cat_id' => $request->input('cat_id')
        ]);
    
        return redirect()->route('productos.index')->with('success', 'Se creó correctamente.');
    }
    

    public function destroy($prod_id)
    {
        try {   
            $producto = Producto::find($prod_id);
            if (!$producto) {
                return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
            }

            $producto->delete();
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Producto no se puede eliminar');
        }
    }
    public function formulario(){

        $categorias = Categoria::pluck('cat_nombre','cat_id');
        return view('productos.formulario',compact('categorias'));
       }

    public function edit($prod_id)
    {
        $producto = Producto::find($prod_id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $prod_id)
    {
        $producto = Producto::find($prod_id);
        $producto->prod_nombre = $request->input('prod_nombre');
        $producto->prod_descripcion = $request->input('prod_descripcion');
        $producto->prod_precioventa = $request->input('prod_precioventa');
        $producto->prod_preciocosto = $request->input('prod_preciocosto');
        $producto->cat_id = $request->input('cat_id'); // Asumiendo que 'cat_id' es la clave foránea

        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

}
