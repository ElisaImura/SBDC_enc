<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function index()
    {
        return view('log.login');
    }

    public function authenticate(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usu_nombre' => 'required',
            'usu_contra' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (auth()->attempt(['usu_nombre' => $request->usu_nombre, 'password' => $request->usu_contra])) {
            // Autenticación exitosa
            return redirect()->route('ventas.index');
        } else {
            // Autenticación fallida
            return back()->with('error', 'Usuario o contraseña incorrectos');
        }
    }
}
