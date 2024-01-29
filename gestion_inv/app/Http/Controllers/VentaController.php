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
        $venta_detalles = Venta_detalle::all(); // Obtén todas las categorías
        $ventas = Venta::all(); // Obtén todas las categorías
        $productos = Producto::all(); // Obtén todos los productos
        $clientes = Cliente::pluck('cli_nombre','cli_id');
        return view('ventas.index', compact('venta_detalles', 'productos', 'clientes','ventas'));
    }

    public function createTempTable()
    {
        // Verifica si la tabla temporal ya existe y, si es así, elimínala
        if (Schema::hasTable('temp_venta_detalles')) {
            Schema::dropIfExists('temp_venta_detalles');
        }
    
        // Crea la nueva tabla temporal
        Schema::create('temp_venta_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prod_id');
            $table->decimal('dventa_precio');
            $table->integer('dventa_cantidad');           


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
            return 'Tabla temporal creada exitosamente';
        }

        // Procede a insertar los datos en la tabla temporal sin un modelo
        DetalleTemp::create([
            'prod_id' => $request->input('prod_id'),
            'dventa_precio' => $request->input('dventa_precio'),
            'dventa_cantidad' => $request->input('dventa_cantidad'),
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
}
