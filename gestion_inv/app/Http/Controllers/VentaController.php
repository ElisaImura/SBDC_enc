<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Venta_detalle;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas_detalle = Venta_detalle::all(); // Obtén todas las categorías
        return view('ventas.index', compact('ventas_detalle'));
    }
    
    
    public function create(Request $request)
    {
        $rules = [
            'venta_id' => 'required',
            'prod_id' => 'required',
            'dventa_precio' => 'required',
            'dventa_cantidad' => 'required',
            'dventa_iva' => 'required',
        ];
    
        $mensaje = [
            'required' => 'El :attribute campo es requerido',
        ];
    
        $this->validate($request, $rules, $mensaje);
    
        Venta_detalle::create([
            'venta_id' => $request->input('venta_id'),
            'prod_id' => $request->input('prod_id'),
            'dventa_precio' => $request->input('dventa_precio'),
            'dventa_cantidad' => $request->input('dventa_cantidad'),
            'dventa_iva' => $request->input('dventa_iva'),
        ]);
    
        return redirect()->route('ventas.index')->with('success', 'Se creó correctamente.');
    }
    
    
        /*public function destroy($cat_id)
        {
            try {
                $categoria = Categoria::find($cat_id);
                if (!$categoria) {
                    return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada');
                }
    
                $categoria->delete();
                return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
            } catch (\Exception $e) {
                return redirect()->route('categorias.index')->with('error', 'Categoría no se puede eliminar');
            }
        }
    
        public function edit($cat_id)
        {
            $categoria = Categoria::find($cat_id);
            return view('categorias.edit', compact('categoria'));
        }
    
        public function update(Request $request, $cat_id)
        {
            $categoria = Categoria::find($cat_id);
            $categoria->cat_nombre = $request->input('cat_nombre');
    
            $categoria->save();
            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
        }
    
        public function show($cat_id)
        {
            $categoria = Categoria::find($cat_id);
            return view('categorias.ver', compact('categoria'));
        }
    
        public function buscar(Request $request)
        {
            $buscar = $request->input('buscar');
            $categorias = Categoria::where('cat_nombre', 'like', "%$buscar%")->paginate(2);
            $vacio = $categorias->isEmpty();
            return view('categorias.index', compact('categorias', 'buscar', 'vacio'));
        }*/
}
