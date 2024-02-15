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
            'prod_imagen' => 'nullable|mimes:jpeg,jpg,png',
        ];

        $mensaje = [
            'required' => 'El :attribute campo es requerido',
        ];

        $this->validate($request, $rules, $mensaje);

        $imagen = null;

        // Verifica si se ha enviado una imagen
        if ($request->hasFile('prod_imagen')) {
            // Mueve la imagen al directorio deseado
            $imagen = time().".".$request->prod_imagen->extension();
            $request->prod_imagen->move(public_path("image"), $imagen);
        }

        // Crear nuevo producto
        Producto::create([
            'prod_nombre' => $request->input('prod_nombre'),
            'prod_descripcion' => $request->input('prod_descripcion'),
            'prod_cant' => 0,
            'prod_precioventa' => 0,
            'prod_preciocosto' => 0,
            'prod_imagen' => $imagen, 
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

    public function edit($prod_id, Request $request)
    {
        $producto = Producto::find($prod_id);
        $source = $request->input('source');
        return view('productos.edit', ['source' => $source], compact('producto'));
    }

    public function update(Request $request, $prod_id)
    {
        $producto = Producto::find($prod_id);
        $producto->prod_nombre = $request->input('prod_nombre');
        $producto->prod_descripcion = $request->input('prod_descripcion');
        $producto->cat_id = $request->input('cat_id'); // Asumiendo que 'cat_id' es la clave foránea
        $producto->save();

        // Verifica el valor del parámetro 'source' para determinar la redirección
        if ($request->input('source') === 'media') {
            return redirect()->route('media.index')->with('success', 'Producto actualizado correctamente');
        } else {
            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
        }
    }

    public function show($prod_id)
{
    $producto = Producto::with('categoria')->findOrFail($prod_id);
    return view('productos.show', compact('producto'));
}

}
