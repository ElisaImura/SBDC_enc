<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta_detalle;
use App\Models\Compra_detalle;
use App\Models\DetalleTemp;
use App\Models\PresupuestoDetalleTemp;
use App\Models\TempCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

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
            'cat_id' => 'required',
            'prod_descripcion' => 'required',
            'prod_imagen' => 'nullable|mimes:jpeg,jpg,png',
        ];

        $mensaje = [
            'required' => 'El :attribute campo es requerido',
            'cat_id.required' => 'El campo de categoría es requerido',
        ];

        $this->validate($request, $rules, $mensaje);

        $imagen = null;

        // Verifica si se ha enviado una imagen
        if ($request->hasFile('prod_imagen')) {
            // Mueve la imagen al directorio deseado
            $imagen = $request->prod_imagen->getClientOriginalName();
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
        // Obtener el nombre de la imagen asociada al producto
        $producto = Producto::findOrFail($prod_id);
        $imagen = $producto->prod_imagen;

        // Verificar si el producto está siendo utilizado en alguna venta
        $ventaDetalles = Venta_detalle::where('prod_id', $prod_id)->exists();
        // Verificar si el producto está siendo utilizado en alguna compra
        $compraDetalles = Compra_detalle::where('prod_id', $prod_id)->exists();
        
        // Inicializar $detallesTemp
        $detallesTemp = false;
        $presupuestoDetallesTemp = false;
        $tempCompraDetalles = false;

        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            // Verificar si el producto está siendo utilizado en alguna detalle de presupuesto temporal
            $presupuestoDetallesTemp = PresupuestoDetalleTemp::where('prod_id', $prod_id)->exists();
        }

        if (Schema::hasTable('DetalleTemp')) {
            // Verificar si el producto está siendo utilizado en alguna detalle temporal
            $detallesTemp = DetalleTemp::where('prod_id', $prod_id)->exists();
        }

        if (Schema::hasTable('TempCompra')) {
            // Verificar si el producto está siendo utilizado en alguna detalle de compra temporal
            $tempCompraDetalles = TempCompra::where('prod_id', $prod_id)->exists();
        }

        if ($ventaDetalles || $compraDetalles || $detallesTemp || $presupuestoDetallesTemp || $tempCompraDetalles) {
            return redirect()->route('productos.index')->with('error', 'No se puede eliminar el producto porque está siendo utilizado en ventas, compras u otras operaciones.');
        }



        // Si el producto no está siendo utilizado en ninguna tabla, eliminarlo
        $producto->delete();

        // Eliminar la imagen asociada al producto
        if (!empty($imagen)) {
            $path = public_path('image') . '/' . $imagen;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
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
        // Validación de entrada
        $rules = [
            'prod_nombre' => 'required',
            'cat_id' => 'required',
            'prod_descripcion' => 'required',
            'prod_imagen' => 'nullable|mimes:jpeg,jpg,png',
        ];

        $mensaje = [
            'required' => 'El :attribute campo es requerido',
            'cat_id.required' => 'El campo de categoría es requerido',
        ];

        $this->validate($request, $rules, $mensaje);

        $imagen = null;

        // Verifica si se ha enviado una imagen
        if ($request->hasFile('prod_imagen')) {
            // Mueve la imagen al directorio deseado
            $imagen = time().".".$request->prod_imagen->extension();
            $request->prod_imagen->move(public_path("image"), $imagen);
        }

        $producto = Producto::find($prod_id);

        // Eliminar la imagen asociada al producto
        if (!empty($producto->prod_imagen)) {
            $path = public_path('image') . '/' . $producto->prod_imagen;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $producto->prod_nombre = $request->input('prod_nombre');
        $producto->prod_descripcion = $request->input('prod_descripcion');
        $producto->cat_id = $request->input('cat_id'); // Asumiendo que 'cat_id' es la clave foránea
        $producto->prod_imagen = $imagen;
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
