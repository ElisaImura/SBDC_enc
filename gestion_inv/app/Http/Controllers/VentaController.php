<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Venta_detalle;
use App\Models\Cliente;
use App\Models\DetalleTemp;
use App\Models\Venta;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        if (Schema::hasTable('temp_venta_detalles')) {
            $venta_detalles = Venta_detalle::all(); // Obtén todas las categorías
            $ventas = Venta::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $clientes = Cliente::pluck('cli_nombre','cli_id');
            $temp_venta_detalles = DetalleTemp::all();
            return view('ventas.index', compact('venta_detalles', 'productos', 'clientes','ventas', 'temp_venta_detalles'));
        }else{
            $venta_detalles = Venta_detalle::all(); // Obtén todas las categorías
            $ventas = Venta::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $clientes = Cliente::pluck('cli_nombre','cli_id');
            return view('ventas.index', compact('venta_detalles', 'productos', 'clientes','ventas'));
        }
        
    }

    public function createTempTable()
    {
        // Verifica si la tabla temporal ya existe y, si es así, elimínala
        if (Schema::hasTable('temp_venta_detalles')) {
            Schema::dropIfExists('temp_venta_detalles');
        }
    
        // Crea la nueva tabla temporal
        Schema::create('temp_venta_detalles', function (Blueprint $table) {
            $table->id('temp_id');
            $table->unsignedBigInteger('prod_id');
            $table->integer('dventa_precio');
            $table->integer('dventa_cantidad');           
            $table->integer('total');

            $table->foreign('prod_id')->references('prod_id')->on('productos');
    
            $table->timestamps();
        });
    
    
        return redirect()->route('ventas.index')->with('success', 'Se creó correctamente.');
    }

    
    public function createDetalleTemp(Request $request)
{
    // Verifica si la tabla temporal existe
    if (!Schema::connection('mysql')->hasTable('temp_venta_detalles')) {
        // La tabla no existe, crea la tabla temporal
        $this->createTempTable();
    }

    // Procede a insertar los datos en la tabla temporal sin un modelo
    $total = $request->input('total') ?? 0; // Asigna un valor predeterminado si 'total' no está presente en la solicitud

    DB::table('temp_venta_detalles')->insert([
        'prod_id' => $request->input('prod_id'),
        'dventa_precio' => $request->input('dventa_precio'),
        'dventa_cantidad' => $request->input('dventa_cantidad'),
        'total' => $total,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('ventas.index')->with('success', 'Se creó correctamente.');
}
    public function createVenta(Request $request)
    {

        Venta::create([
            'cli_id' => $request->input('cli_id'),
            'venta_fecha' => Carbon::now(), 
        ]);
    }

    public function createDetalle(Request $request)
    {

        $rules = [
            'venta_id' => 'required',
            'prod_id' => 'required',
            'dventa_precio' => 'required',
            'dventa_cantidad' => 'required',
        ];
    
        $mensaje = [
            'required' => 'El :attribute campo es requerido',
        ];
    
        $this->validate($request, $rules, $mensaje);
    
            Venta_detalle::create([
                'venta_id' => $request->input('venta_id'),
                'prod_id' => $request->input('prod_id'),
                'dventa_precio' => $request->input('dventa_precio'),
                'dventa_cantidad' => $request->input('dventa_cantidad'),
            ]);
        return redirect()->route('ventas.index')->with('success', 'Se creó correctamente.');
    }

    public function destroy($temp_id)
    {
            $temp_venta_detalles = DetalleTemp::find($temp_id);
            if (!$temp_venta_detalles) {
                return redirect()->route('ventas.index')->with('error', 'Venta no encontrada');
            }

            $temp_venta_detalles->delete();
            return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');

    }

    public function edit($temp_id)
    {
        $temp_venta_detalles = DetalleTemp::find($temp_id);
        $productos = Producto::all();
        return view('ventas.edit', compact('temp_venta_detalles','productos'));
    }
    
    public function update(Request $request, $temp_id)
    {
        $temp_venta_detalles = DetalleTemp::find($temp_id);
        $temp_venta_detalles->prod_id = $request->input('prod_id');
        $temp_venta_detalles->dventa_cantidad = $request->input('dventa_cantidad');
        $temp_venta_detalles->dventa_precio = $request->input('dventa_precio');


        $temp_venta_detalles->save();
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
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


}

    
    