<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Compra;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all(); // Obtén todos los proveedores
        return view('proveedores.index', compact('proveedores'));
    }

    public function create(Request $request)
    {
        // Validación de entrada
        $rules = [
            'prove_nombre' => 'required',
            'prove_ruc' => 'required',
        ];
    
        $mensaje = [
            'required' => 'El :attribute campo es requerido',
            //'exists' => 'La categoría seleccionada no es válida',
        ];
    
        $this->validate($request, $rules, $mensaje);

        Proveedor::create([
            'prove_nombre' => $request->input('prove_nombre'),
            'prove_ruc' => $request->input('prove_ruc'),

        ]);
    
        return redirect()->route('proveedores.index')->with('success', 'Se creó correctamente.');
    }

    public function destroy($prove_id)
    {
        // Verificar si el proveedor está siendo utilizado en alguna compra
        $compras = Compra::where('prove_id', $prove_id)->exists();
        if ($compras) {
            return redirect()->route('proveedores.index')->with('error', 'No se puede eliminar el proveedor porque está siendo utilizado en una o más compras.');
        }

        // Si el proveedor no está siendo utilizado en ninguna compra, eliminarlo
        $proveedor = Proveedor::find($prove_id);

        if (!$proveedor) {
            return redirect()->route('proveedores.index')->with('error', 'Proveedor no encontrado');
        }

        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }

    public function formulario(){

        return view('proveedores.formulario');
       }

    public function edit($prove_id)
    {
        $proveedor= Proveedor::find($prove_id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $prove_id)
    {
        $proveedor= Proveedor::find($prove_id);
        $proveedor->prove_nombre = $request->input('prove_nombre');
        $proveedor->prove_ruc = $request->input('prove_ruc');
   

        $proveedor->save();
        return redirect()->route('proveedores.index')->with('success', 'proveedor actualizado correctamente');
    }

    public function show($prove_id)
{
    $proveedor= Proveedor::with('proveedor')->findOrFail($prove_id);
    return view('proveedores.show', compact('proveedor'));
}
}
