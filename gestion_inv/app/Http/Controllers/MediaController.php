<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtener los productos según la búsqueda
        $productos = Producto::query()
            ->where('prod_nombre', 'like', '%' . $search . '%')
            ->orWhere('prod_descripcion', 'like', '%' . $search . '%')
            ->orWhereHas('categoria', function ($query) use ($search) {
                $query->where('cat_nombre', 'like', '%' . $search . '%');
            })
            ->get();

        return view('media.index', compact('productos'));
    }

    public function search(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $search = $request->input('search');

        // Realizar la búsqueda de productos que coincidan con el término
        $productos = Producto::query()
            ->where('prod_nombre', 'like', '%' . $search . '%')
            ->orWhere('prod_descripcion', 'like', '%' . $search . '%')
            ->orWhereHas('categoria', function ($query) use ($search) {
                $query->where('cat_nombre', 'like', '%' . $search . '%');
            })
            ->get();

        // Retornar la vista con los resultados de la búsqueda
        return view('media.index', compact('productos'));
    }

}
