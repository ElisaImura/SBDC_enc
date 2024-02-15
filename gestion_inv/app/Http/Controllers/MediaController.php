<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class MediaController extends Controller
{
    public function index()
    {
        $productos = Producto::all(); // Obtén todos los productos
        return view('media.index', compact('productos'));
    }
}
