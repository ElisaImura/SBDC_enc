<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
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
