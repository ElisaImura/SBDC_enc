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
    public function formularioCliente()
    {
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            $venta_detalles = Venta_detalle::all();
            $compra_detalles = Compra_detalle::all();
            $clientes = Cliente::all();
            $proveedores = Proveedor::all();
            return view('reportes.cliente', compact( 'ventas', 'compras','clientes','proveedores'));
        }else{
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            $venta_detalles = Venta_detalle::all();
            $compra_detalles = Compra_detalle::all();
            $clientes = Cliente::all();
            $proveedores = Proveedor::all();
            return view('reportes.cliente', compact( 'ventas', 'compras','clientes','proveedores'));
        }

    }
    public function formularioProveedor()
    {
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            $venta_detalles = Venta_detalle::all();
            $compra_detalles = Compra_detalle::all();
            $clientes = Cliente::all();
            $proveedores = Proveedor::all();
            return view('reportes.proveedor', compact( 'ventas', 'compras','clientes','proveedores'));
        }else{
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            $venta_detalles = Venta_detalle::all();
            $compra_detalles = Compra_detalle::all();
            $clientes = Cliente::all();
            $proveedores = Proveedor::all();
            return view('reportes.proveedor', compact( 'ventas', 'compras','clientes','proveedores'));
        }

    }

    public function generar(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_reporte' => 'required|in:ventas,compras',
        ]);

        // Lógica para obtener los datos necesarios para el reporte
        $datos = $this->obtenerDatos($request);
        $tipoReporte = $request->input('tipo_reporte'); // Obtener el tipo de reporte
        $total = count($datos[$tipoReporte]);
        // Generar la vista del reporte en formato PDF
        $pdf = PDF::loadView('reportes.pdf', ['datos' => $datos, 'tipoReporte' => $tipoReporte,'total' => $total]);

        // Descargar el PDF o mostrarlo en el navegador
        return $pdf->download('reportes.pdf');
    }

    private function obtenerDatos(Request $request)
{
    // Obtener fechas del formulario
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');
    $tipoReporte = $request->input('tipo_reporte');
    $nombreCliente = $request->input('nombre_cliente'); // Nombre del cliente
    $nombreProveedor = $request->input('nombre_proveedor'); // Nombre del proveedor

    // Consulta de datos filtrada por fechas y tipo de reporte
    $datos = [];

    if ($tipoReporte === 'ventas') {
        // Si el nombre del cliente es "todo", no aplicar ningún filtro por cliente
        if ($nombreCliente && $nombreCliente !== 'todo') {
            $datos['ventas'] = Venta::with('detalles')
                                    ->whereHas('cliente', function ($query) use ($nombreCliente) {
                                        $query->where('cli_nombre', $nombreCliente);
                                    })
                                    ->whereBetween('venta_fecha', [$fechaInicio, $fechaFin])
                                    ->get();
        } else {
            // Obtener todas las ventas en el rango de fechas
            $datos['ventas'] = Venta::with('detalles')
                                    ->whereBetween('venta_fecha', [$fechaInicio, $fechaFin])
                                    ->get();
        }
    } else {
        // Si el nombre del proveedor es "todo", no aplicar ningún filtro por proveedor
        if ($nombreProveedor && $nombreProveedor !== 'todo') {
            $datos['compras'] = Compra::with('detalles')
                                    ->whereHas('proveedor', function ($query) use ($nombreProveedor) {
                                        $query->where('prove_nombre', $nombreProveedor);
                                    })
                                    ->whereBetween('compra_fecha', [$fechaInicio, $fechaFin])
                                    ->get();
        } else {
            // Obtener todas las compras en el rango de fechas
            $datos['compras'] = Compra::with('detalles')
                                    ->whereBetween('compra_fecha', [$fechaInicio, $fechaFin])
                                    ->get();
        }
    }

    return $datos;
}



}
