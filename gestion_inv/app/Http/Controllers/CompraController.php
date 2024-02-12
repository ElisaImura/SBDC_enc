<?php


namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Compra_detalle;
use App\Models\TempCompra;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        if (Schema::hasTable('temp_compra_detalles')) {
            $compra_detalles = Compra_detalle::all(); // Obtén todas las categorías
            $compras = Compra::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $proveedores = Proveedor::pluck('prove_nombre','prove_id');
            $temp_compra_detalles = TempCompra::all();
            return view('compras.index', compact('compra_detalles', 'productos', 'proveedores','compras', 'temp_compra_detalles'));
        }else{
            $compra_detalles = Compra_detalle::all(); // Obtén todas las categorías
            $compras = Compra::all(); // Obtén todas las categorías
            $productos = Producto::all(); // Obtén todos los productos
            $proveedores = Proveedor::pluck('prove_nombre','prove_id');
            return view('compras.index', compact('compra_detalles', 'productos', 'proveedores','compras'));
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
            $table->unsignedBigInteger('prod_id');
            $table->integer('dcompra_precio');
            $table->integer('dcompra_pcompra');
            $table->integer('dcompra_pventa');
            $table->integer('dcompra_cantidad');
            $table->foreign('prod_id')->references('prod_id')->on('productos');
    
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
        'prod_id' => $request->input('prod_id'),
        'dcompra_precio' => $request->input('dcompra_pcompra'),
        'dcompra_pcompra' => $request->input('dcompra_pcompra'),
        'dcompra_pventa' => $request->input('dcompra_pventa'),
        'dcompra_cantidad' => $request->input('dcompra_cantidad'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('compras.index')->with('success', 'Se creó correctamente.');
}
    public function createCompra(Request $request)
    {

        Compra::create([
            'prove_id' => $request->input('prove_id'),
            'compra_fecha' => Carbon::now(), 
            'compra_factura' => $request->input('compra_factura'),
        ]);
    }



    public function destroy($temp_id)
    {
            $temp_compra_detalles = TempCompra::find($temp_id);
            if (!$temp_compra_detalles) {
                return redirect()->route('compras.index')->with('error', 'Compra no encontrada');
            }

            $temp_compra_detalles->delete();
            return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');

    }

    public function edit($temp_id)
    {
        $temp_compra_detalles = TempCompra::find($temp_id);
        $IDproductoSeleccionado = $temp_compra_detalles->prod_id;
        $productos = Producto::all();
        $ProductoSeleccionado = Producto::find($IDproductoSeleccionado); // Corregir aquí
        $cantidad = $ProductoSeleccionado->prod_cant;
        return view('compras.edit', compact('temp_compra_detalles', 'productos', 'cantidad'));
    }

    
    public function update(Request $request, $temp_id)
    {
        $temp_compra_detalles = TempCompra::find($temp_id);
        $temp_compra_detalles->prod_id = $request->input('prod_id');
        $temp_compra_detalles->dcompra_cantidad = $request->input('dcompra_cantidad');
        $temp_compra_detalles->dcompra_pcompra = $request->input('dcompra_pcompra');
        $temp_compra_detalles->dcompra_pventa = $request->input('dcompra_pventa');

        $temp_compra_detalles->save();
        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente');
    }

    public function concretarCompra(Request $request)
    {
      
        if (Schema::hasTable('temp_compra_detalles')) {
            $compra = Compra::create([
                'prove_id' => $request->input('prove_id'),
                'compra_factura' => $request->input('compra_factura'),
                'compra_fecha' => Carbon::now(),
            ]);

            $productosTemporales = TempCompra::all();
            foreach ($productosTemporales as $productoTemporal) {
                Compra_detalle::create([
                'compra_id'=>$compra->compra_id,
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
            return redirect()->route('compras.index')->with('success', 'compra creada correctamente');
        }else{
            return redirect()->route('compras.index')->with('error', 'No se puede crear compra sin detalles');
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

    
    