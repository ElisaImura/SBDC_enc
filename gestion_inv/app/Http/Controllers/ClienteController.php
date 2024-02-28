<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); // Obtén todos los clientes
        return view('clientes.index', compact('clientes'));
    }

    public function create(Request $request)
    {
        // Validación de entrada
        $rules = [
            'cli_nombre' => 'required',
            'cli_apellido' => 'required',
            'cli_ruc' => 'required',
            'cli_direccion' => 'required',
            'cli_telefono' => 'required',
            //'cat_id' => 'required|exists:categorias,cat_id',
        ];
    
        $mensaje = [
            'required' => 'El :attribute campo es requerido',
            //'exists' => 'La categoría seleccionada no es válida',
        ];
    
        $this->validate($request, $rules, $mensaje);
    
        // Obtenemos el cat_id del request después de la validació
    
        // Verificamos si la categoría existe
    
        // Crear nuevo producto
        Cliente::create([
            'cli_nombre' => $request->input('cli_nombre'),
            'cli_apellido' => $request->input('cli_apellido'),
            'cli_ruc' => $request->input('cli_ruc'),
            'cli_direccion' => $request->input('cli_direccion'),
            'cli_telefono' => $request->input('cli_telefono'),
        ]);
    
        return redirect()->route('clientes.index')->with('success', 'Se creó correctamente.');
    }
    

    public function destroy($cli_id)
    {
    // Verificar si el cliente está siendo utilizado en alguna venta
        $ventas = Venta::where('cli_id', $cli_id)->exists();

        if ($ventas) {
            return redirect()->route('clientes.index')->with('error', 'No se puede eliminar el cliente porque está siendo utilizado en una o más ventas.');
        }

        // Si el cliente no está siendo utilizado en ninguna venta, eliminarlo
        $cliente = Cliente::find($cli_id);

        if (!$cliente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado');
        }

        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }

    public function formulario(){

        return view('clientes.formulario');
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
