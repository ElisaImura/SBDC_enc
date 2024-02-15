<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtener los productos según la búsqueda
        $productos = Producto::query()
            ->where('prod_nombre', 'like', '%' . $search . '%')
            ->orWhere('prod_descripcion', 'like', '%' . $search . '%')
            ->get();

        return view('media.index', compact('productos'));
    }

}
