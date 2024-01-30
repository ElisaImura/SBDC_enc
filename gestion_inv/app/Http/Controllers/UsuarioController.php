<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all(); // Obtén todos los usuarios
        return view('usuarios.index', compact('usuarios'));
    }

    public function formulario(){

        return view('usuarios.formulario');
    }

    public function registrarUsuario(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usu_nombre' => 'required|unique:usuarios,usu_nombre',
            'usu_contra' => 'required|min:8',
            // Otros campos de validación si es necesario
        ]);

        // Crear una nueva instancia del modelo Usuario
        $usuario = new Usuario();

        // Asignar los valores del formulario al modelo
        $usuario->usu_nombre = $request->usu_nombre;
        $usuario->usu_contra = Hash::make($request->usu_contra); // Utilizar Hash::make para cifrar la contraseña

        // Guardar el usuario en la base de datos
        $usuario->save();

        // Puedes autenticar al usuario automáticamente si lo deseas
        auth()->guard('web')->login($usuario);

        // Redirigir a la página de inicio o a donde desees después del registro
        return redirect()->route('dashboard');
    }
}
