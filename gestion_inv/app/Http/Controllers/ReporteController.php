<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Compra;
use Illuminate\Support\Facades\Schema;
use PDF;

class ReporteController extends Controller
{
    public function formulario()
    {
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            return view('reportes.index', compact( 'ventas', 'compras'));
        }else{
            $ventas = Venta::all(); // Obtén todos los ventas
            $compras = Compra::all();
            return view('reportes.index', compact( 'ventas', 'compras'));
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

        // Consulta de datos filtrada por fechas y tipo de reporte
        $datos = [];
        if ($tipoReporte === 'ventas') {
            $datos['ventas'] = Venta::whereBetween('venta_fecha', [$fechaInicio, $fechaFin])->get();
        } else {
            $datos['compras'] = Compra::whereBetween('compra_fecha', [$fechaInicio, $fechaFin])->get();
        }

        return $datos;
    }
}
