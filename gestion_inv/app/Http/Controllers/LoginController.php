<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Stock;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function dashboard()
    {
        // Calcular el total de compras
        $totalCompras = Compra::count();

        // Calcular el total de ventas
        $totalVentas = Venta::count();

        // Calcular el total de productos
        $totalProductos = Producto::count();

        // Obtener el stock mínimo
        $stockMinimo = Stock::pluck('stock_min')->first();

        // Verificar si la tabla de productos está vacía
        if (Producto::isEmpty()) {
            // La tabla de productos está vacía
            $totalCritico = 0; // No hay productos críticos si la tabla está vacía
        } else {
            // La tabla de productos no está vacía, calcular el total de productos con stock crítico
            $totalCritico = Producto::where('prod_cant', '<', $stockMinimo)->count();
        }
        
        // Calcular el total de compras
        $totalClientes = Cliente::count();

        // Calcular el total de ventas
        $totalProveedores = Proveedor::count();

        // Calcular el total de productos
        $totalCategorias = Categoria::count();


        // Pasar los datos al dashboard
        return view('dashboard', compact('totalCompras', 'totalVentas', 'totalProductos', 'totalClientes', 'totalProveedores', 'totalCategorias', 'totalCritico'));
    }

    public function register(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        
        $user->save();

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    public function login(Request $request)
    {
        $credentials = [
            "name" => $request->name,
            "password" => $request->password,
        ];

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));

        }else{
            return redirect()->route('login')->with('error', 'Las credenciales no son correctas.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route('inicio'));
    }
}
