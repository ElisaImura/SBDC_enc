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

    public function create(Request $request)
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

    public function destroy($cli_id)
    {
        try {   
            $cliente = Cliente::find($cli_id);

            if (!$cliente) {
                return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado');
            }

            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Cliente no se puede eliminar');
        }
    }

    public function edit($cli_id)
    {
        $cliente = Cliente::find($cli_id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $cli_id)
    {
        $cliente = Cliente::find($cli_id);
        $cliente->cli_nombre = $request->input('cli_nombre');
        $cliente->cli_apellido = $request->input('cli_apellido');
        $cliente->cli_ruc = $request->input('cli_ruc');
        $cliente->cli_direccion = $request->input('cli_direccion');
        $cliente->cli_telefono = $request->input('cli_telefono');
   

        $cliente->save();
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function show($cli_id)
    {
        $cliente = Cliente::with('cliente')->findOrFail($cli_id);
        return view('clientes.show', compact('cliente'));
    }
}
