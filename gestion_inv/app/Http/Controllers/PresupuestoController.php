<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Venta_detalle;
use App\Models\Cliente;
use App\Models\PresupuestoDetalleTemp;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PresupuestoController extends Controller
{
    public function index()
    {
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            $venta_detalles = Venta_detalle::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $clientes = Cliente::pluck('cli_nombre','cli_id');
            $Presupuesto_temp_venta_detalles = PresupuestoDetalleTemp::all();
            return view('presupuestos.index', compact('venta_detalles', 'productos', 'clientes','Presupuesto_temp_venta_detalles'));
        }else{
            $venta_detalles = Venta_detalle::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $clientes = Cliente::pluck('cli_nombre','cli_id');
            return view('presupuestos.index', compact('venta_detalles', 'productos', 'clientes'));
        }
        
    }

    public function createTempTable()
    {


        // Verifica si la tabla temporal ya existe y, si es así, elimínala
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            Schema::dropIfExists('Presupuesto_temp_venta_detalles');
        }
    
        // Crea la nueva tabla temporal
        Schema::create('Presupuesto_temp_venta_detalles', function (Blueprint $table) {
            $table->id('temp_id');
            $table->unsignedBigInteger('prod_id');
            $table->integer('dventa_precio');
            $table->integer('dventa_cantidad');           
            $table->integer('total');

            $table->foreign('prod_id')->references('prod_id')->on('productos');
    
            $table->timestamps();
        });
    
    
        return redirect()->route('presupuesto.index')->with('success', 'Se creó correctamente.');
    }

    
    public function createDetalleTemp(Request $request)
    {
        // Verifica si la tabla temporal existe
        if (!Schema::connection('mysql')->hasTable('Presupuesto_temp_venta_detalles')) {
            // La tabla no existe, crea la tabla temporal
            $this->createTempTable();
        }

        // Procede a insertar los datos en la tabla temporal sin un modelo
        $total = $request->input('total') ?? 0; // Asigna un valor predeterminado si 'total' no está presente en la solicitud

        DB::table('Presupuesto_temp_venta_detalles')->insert([
            'prod_id' => $request->input('prod_id'),
            'dventa_precio' => $request->input('dventa_precio'),
            'dventa_cantidad' => $request->input('dventa_cantidad'),
            'total' => $total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('presupuesto.index')->with('success', 'Se creó correctamente.');
    }


    public function destroy($temp_id)
    {
            $Presupuesto_temp_venta_detalles = PresupuestoDetalleTemp::find($temp_id);
            if (!$Presupuesto_temp_venta_detalles) {
                return redirect()->route('presupuesto.index')->with('error', 'Venta no encontrada');
            }

            $Presupuesto_temp_venta_detalles->delete();
            return redirect()->route('presupuesto.index')->with('success', 'Venta eliminada correctamente');

    }

    public function edit($temp_id)
    {
        $Presupuesto_temp_venta_detalles = PresupuestoDetalleTemp::find($temp_id);
        $IDproductoSeleccionado = $Presupuesto_temp_venta_detalles->prod_id;
        $productos = Producto::all();
        $ProductoSeleccionado = Producto::find($IDproductoSeleccionado); // Corregir aquí
        $cantidad = $ProductoSeleccionado->prod_cant;
        return view('presupuestos.edit', compact('Presupuesto_temp_venta_detalles', 'productos', 'cantidad'));
    }

    
    public function update(Request $request, $temp_id)
    {
        $Presupuesto_temp_venta_detalles = PresupuestoDetalleTemp::find($temp_id);
        $Presupuesto_temp_venta_detalles->prod_id = $request->input('prod_id');
        $Presupuesto_temp_venta_detalles->dventa_cantidad = $request->input('dventa_cantidad');
        $Presupuesto_temp_venta_detalles->dventa_precio = $request->input('dventa_precio');
        $Presupuesto_temp_venta_detalles->total = $request->input('total');

        $Presupuesto_temp_venta_detalles->save();
        return redirect()->route('presupuesto.index')->with('success', 'Venta actualizada correctamente');
    }

    public function obtenerPrecioProducto($prod_id)
    {
        // Lógica para obtener el precio del producto
        $producto = Producto::find($prod_id);

        if ($producto) {
            return response()->json(['precio' => $producto->prod_precioventa], 200);
        } else {
            return response()->json(['error' => 'Producto no encontrado o precio no disponible'], 404);
        }
    }

    public function reiniciar(Request $request)
    {
      
        if (Schema::hasTable('Presupuesto_temp_venta_detalles')) {
            // Paso 3: Eliminar los datos de la tabla temporal
            Schema::dropIfExists('Presupuesto_temp_venta_detalles');

            // Redirigir o devolver una respuesta como sea necesario
            return redirect()->route('presupuesto.index')->with('success', 'Presupuesto reiniciado correctamente');
        }else{
            return redirect()->route('presupuesto.index')->with('error', 'No existe presupuesto para reiniciar');
        }
    }

    public function verificarProducto($prod_id)
    {
        // Buscar el detalle en la tabla temporal que coincide con el prod_id
        $detalle = DB::table('Presupuesto_temp_venta_detalles')
            ->where('prod_id', $prod_id)
            ->first();

        // Verificar si se encontró el detalle
        if ($detalle) {
            // Si el detalle existe, devolver su ID en la respuesta JSON
            return response()->json(['existe' => true, 'temp_id' => $detalle->temp_id]);
        } else {
            // Si no se encuentra el detalle, devolver false en la respuesta JSON
            return response()->json(['existe' => false]);
        }
    }

    public function generarPDF(){
        $Presupuesto_temp_venta_detalles = PresupuestoDetalleTemp::all();
        
        // Calcula el total de los detalles
        $totalDetalles = $Presupuesto_temp_venta_detalles->sum('total');
        
        // Carga la vista del PDF con los detalles y el total
        $pdf = PDF::loadView('presupuestos.pdf', compact('Presupuesto_temp_venta_detalles', 'totalDetalles'));
        
        // Descarga el PDF
        return $pdf->download('presupuestos.pdf');
    }
    
    public function recargarVista() {

        $this->generarPDF();

        // Elimina la tabla
        Schema::dropIfExists('Presupuesto_temp_venta_detalles');

        // Redirige al usuario de vuelta a la vista
        return redirect()->route('presupuesto.index')->with('success', 'Presupuesto creado con éxito.');
    }
}
