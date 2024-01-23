<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
{
    $categorias = Categoria::all(); // Obtén todas las categorías
    return view('categorias.index', compact('categorias'));
}


public function create(Request $request)
{
    $rules = [
        'cat_nombre' => 'required',
    ];

    $mensaje = [
        'required' => 'El :attribute campo es requerido',
    ];

    $this->validate($request, $rules, $mensaje);

    Categoria::create([
        'cat_nombre' => $request->input('cat_nombre'),
    ]);

    return redirect()->route('categorias.index')->with('success', 'Se creó correctamente.');
}


    public function destroy($cat_id)
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
    }
}
