<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\Compra_detalle;
use App\Models\Proveedor;
use App\Models\Venta_detalle;
use Illuminate\Support\Facades\Schema;
use PDF;

class ReporteController extends Controller
{
    public function formulario()
    {
        $proveedores = Proveedor::orderBy('prove_nombre')->get();
        $clientes = Cliente::orderBy('cli_nombre')->get();
        return view('reportes.reportes',compact('proveedores','clientes'));
    }

    public function generar(Request $request)
    {
        $stock_min = null;
        // Lógica para obtener los datos necesarios para el reporte
        $datos = $this->obtenerDatos($request);
        if($request->has('tipo_ventas')){
            $tipoReporte = 'ventas';
        }elseif($request->has('tipo_compras')){
            $tipoReporte = 'compras';
        }else{
            $tipoReporte = 'stock';
        }
        $todo = $request->has('todo');
        if ($tipoReporte != 'stock' && !$todo) {
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');
        } else {
            $stock = Stock::first(); // Obtener el primer registro de la tabla Stock
            $stock_min = $stock->stock_min; // Obtener el valor del atributo stock_min
            $fechaInicio = null;
            $fechaFin = null;
        }
        $total = count($datos[$tipoReporte]);
        // Generar la vista del reporte en formato PDF
        $pdf = PDF::loadView('reportes.pdf', ['datos' => $datos, 'tipoReporte' => $tipoReporte,'total' => $total, 'todo' => $todo, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'stock_min' => $stock_min]);

        // Descargar el PDF o mostrarlo en el navegador
        return $pdf->download('reportes.pdf');
    }

    private function obtenerDatos(Request $request)
    {
        // Obtener fechas del formulario
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        if($request->has('tipo_ventas')){
            $tipoReporte = 'ventas';
        }elseif($request->has('tipo_compras')){
            $tipoReporte = 'compras';
        }else{
            $tipoReporte = 'stock';
        }
        $IDCliente = $request->input('cli_id'); // ID del cliente
        $IDProveedor = $request->input('prove_id'); // ID del proveedor
        $todo = $request->has('todo'); //Se refiere a todas las fechas sin rango especifico
        // Consulta de datos filtrada por fechas y tipo de reporte
        $datos = [];

        if($tipoReporte == 'stock'){
            $datos['stock'] = Producto::all();
        }else{
            if(!$todo){
                if ($tipoReporte == 'ventas') {
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
                if ($tipoReporte == 'ventas') {
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
        }

        return $datos;
    }
}