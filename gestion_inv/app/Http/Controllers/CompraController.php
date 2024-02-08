<?php


namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Compra_detalle;
use App\Models\DetalleTemp;
use App\Models\Venta;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        if (Schema::hasTable('temp_compra_detalles')) {
            $compra_detalles = Compra_detalle::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $proveedores = Proveedor::pluck('prove_nombre','prove_id');
            $temp_compra_detalles = DetalleTemp::all();
            return view('compras.index', compact('compra_detalles', 'productos', 'proveedores','ventas', 'temp_compra_detalles'));
        }else{
            $compra_detalles = Compra_detalle::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $proveedor = Proveedor::pluck('prove_nombre','prove_id');
            return view('compras.index', compact('compra_detalles', 'productos', 'proveedores','ventas'));
        }
        
    }

    public function createTempTable()
    {


        // Verifica si la tabla temporal ya existe y, si es así, elimínala
        if (Schema::hasTable('temp_compra_detalles')) {
            Schema::dropIfExists('temp_compra_detalles');
        }
    
        // Crea la nueva tabla temporal
        Schema::create('temp_compra_detalles', function (Blueprint $table) {
            $table->id('temp_id');
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('prod_id');
            $table->integer('dcompra_precio');
            $table->integer('dcompra_cantidad');           
            $table->integer('total');

            $table->foreign('prod_id')->references('prod_id')->on('productos');
            $table->foreign('compra_id')->references('compra_id')->on('compras');
    
            $table->timestamps();
        });
    
        return redirect()->route('compras.index')->with('success', 'Se creó correctamente.');
    }

    
    public function createDetalleTemp(Request $request)
{
    // Verifica si la tabla temporal existe
    if (!Schema::connection('mysql')->hasTable('temp_compra_detalles')) {
        // La tabla no existe, crea la tabla temporal
        $this->createTempTable();
    }

    // Procede a insertar los datos en la tabla temporal sin un modelo
    $total = $request->input('total') ?? 0; // Asigna un valor predeterminado si 'total' no está presente en la solicitud

    DB::table('temp_compra_detalles')->insert([
        'compra_id' => $request->input('compra_id'),
        'prod_id' => $request->input('prod_id'),
        'dcompra_precio' => $request->input('dcompra_precio'),
        'dcompra_cantidad' => $request->input('dcompra_cantidad'),
        'total' => $total,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('compras.index')->with('success', 'Se creó correctamente.');
}
    public function createVenta(Request $request)
    {

        Venta::create([
            'prove_id' => $request->input('prove_id'),
            'venta_fecha' => Carbon::now(), 
        ]);
    }



    public function destroy($temp_id)
    {
            $temp_compra_detalles = DetalleTemp::find($temp_id);
            if (!$temp_compra_detalles) {
                return redirect()->route('compras.index')->with('error', 'Compra no encontrada');
            }

            $temp_compra_detalles->delete();
            return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');

    }

    public function edit($temp_id)
    {
        $temp_compra_detalles = DetalleTemp::find($temp_id);
        $productos = Producto::all();
        return view('compras.edit', compact('temp_compra_detalles','productos'));
    }
    
    public function update(Request $request, $temp_id)
    {
        $temp_compra_detalles = DetalleTemp::find($temp_id);
        $temp_compra_detalles->prod_id = $request->input('prod_id');
        $temp_compra_detalles->compra_id = $request->input('compra_id');
        $temp_compra_detalles->dcompra_cantidad = $request->input('dcompra_cantidad');
        $temp_compra_detalles->dcompra_precio = $request->input('dcompra_precio');
        $temp_compra_detalles->total = $request->input('total');

        $temp_compra_detalles->save();
        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente');
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

    public function concretarVenta(Request $request)
    {
      
        if (Schema::hasTable('temp_compra_detalles')) {
            $venta = Venta::create([
                'prove_id' => $request->input('prove_id'),
                'venta_fecha' => now(),
            ]);

            $productosTemporales = DetalleTemp::all();

            foreach ($productosTemporales as $productoTemporal) {
                Compra_detalle::create([

                'compra_id' => $venta->compra_id,
                'venta_id'=> $productoTemporal->venta_id,
                'prod_id'=> $productoTemporal->prod_id,
                'dcompra_precio'=> $productoTemporal->dcompra_precio,
                'dcompra_cantidad'=> $productoTemporal->dcompra_cantidad,
                ]);
                

                $producto = Producto::find($productoTemporal->prod_id);
                $producto->prod_cant = ($producto->prod_cant)-($productoTemporal->dcompra_cantidad);
                $producto->save();

            }
            // Paso 3: Eliminar los datos de la tabla temporal
            Schema::dropIfExists('temp_compra_detalles');

            // Redirigir o devolver una respuesta como sea necesario
            return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');
        }else{
            return redirect()->route('compras.index')->with('error', 'No se puede crear venta sin detalles');
        }
    }

    public function verificarProducto($prod_id)
    {
        // Buscar el detalle en la tabla temporal que coincide con el prod_id
        $detalle = DB::table('temp_compra_detalles')
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

}

    
    