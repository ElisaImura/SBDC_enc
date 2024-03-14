<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Compra_detalle;
use App\Models\Proveedor;
use App\Models\Venta_detalle;
use Illuminate\Support\Facades\Schema;
use PDF;

class ReporteController extends Controller
{
    public function formulario()
    {
        $ventas = Venta::all(); // Obtén todos los ventas
        $compras = Compra::all();
        $venta_detalles = Venta_detalle::all();
        $compra_detalles = Compra_detalle::all();
        $clientes = Cliente::all();
        $proveedores = Proveedor::all();
        return view('reportes.reportes', compact( 'ventas', 'compras','clientes','proveedores'));
    }

    public function generar(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date|after_or_equal:fecha_inicio',
        ]);

        // Lógica para obtener los datos necesarios para el reporte
        $datos = $this->obtenerDatos($request);
        $tipoReporte = $request->input('tipo_reporte');
        $todo = $request->has('todo');
        if(!$todo){
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');
        }else{
            $fechaInicio = null;
            $fechaFin = null;
        }
        $total = count($datos[$tipoReporte]);
        // Generar la vista del reporte en formato PDF
        $pdf = PDF::loadView('reportes.pdf', ['datos' => $datos, 'tipoReporte' => $tipoReporte,'total' => $total, 'todo' => $todo, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin,]);

        // Descargar el PDF o mostrarlo en el navegador
        return $pdf->download('reportes.pdf');
    }

    private function obtenerDatos(Request $request)
    {
        // Obtener fechas del formulario
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $tipoReporte = $request->input('tipo_reporte');
        $IDCliente = $request->input('cli_id'); // ID del cliente
        $IDProveedor = $request->input('prove_id'); // ID del proveedor
        $todo = $request->has('todo');
        // Consulta de datos filtrada por fechas y tipo de reporte
        $datos = [];

        if(!$todo){
            if ($tipoReporte === 'ventas') {
                // Si el cliente es "todo", no aplicar ningún filtro por cliente
                if ($IDCliente === 'todo') {
                    // Obtener todas las ventas en el rango de fechas
                    $datos['ventas'] = Venta::with('detalles')
                                            ->whereBetween('venta_fecha', [$fechaInicio, $fechaFin])
                                            ->get();
                } else {
                    $datos['ventas'] = Venta::with('detalles')
                                            ->whereHas('cliente', function ($query) use ($IDCliente) {
                                                $query->where('cli_id', $IDCliente);
                                            })
                                            ->whereBetween('venta_fecha', [$fechaInicio, $fechaFin])
                                            ->get();
                }
            } else {
                // Si el proveedor es "todo", no aplicar ningún filtro por proveedor
                if ($IDProveedor === 'todo') {
                    // Obtener todas las compras en el rango de fechas
                    $datos['compras'] = Compra::with('detalles')
                                            ->whereBetween('compra_fecha', [$fechaInicio, $fechaFin])
                                            ->get();
                } else {
                    $datos['compras'] = Compra::with('detalles')
                                            ->whereHas('proveedor', function ($query) use ($IDProveedor) {
                                                $query->where('prove_ID', $IDProveedor);
                                            })
                                            ->whereBetween('compra_fecha', [$fechaInicio, $fechaFin])
                                            ->get();
                }
            }
        }else{
            if ($tipoReporte === 'ventas') {
                // Si el cliente es "todo", no aplicar ningún filtro por cliente
                if ($IDCliente === 'todo') {
                    // Obtener todas las ventas en el rango de fechas
                    $datos['ventas'] = Venta::with('detalles')
                                            ->get();
                } else {
                    $datos['ventas'] = Venta::with('detalles')
                                            ->whereHas('cliente', function ($query) use ($IDCliente) {
                                                $query->where('cli_ID', $IDCliente);
                                            })
                                            ->get();
                }
            } else {
                // Si el proveedor es "todo", no aplicar ningún filtro por proveedor
                if ($IDProveedor === 'todo') {
                    // Obtener todas las compras en el rango de fechas
                    $datos['compras'] = Compra::with('detalles')
                                            ->get();
                } else {
                    $datos['compras'] = Compra::with('detalles')
                                            ->whereHas('proveedor', function ($query) use ($IDProveedor) {
                                                $query->where('prove_ID', $IDProveedor);
                                            })
                                            ->get();
                }
            }
        }

        return $datos;
    }
}