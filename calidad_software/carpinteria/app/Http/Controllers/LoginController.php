<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function ingresar(Request $request)
    {
        
        $usuarios = [
            'admin' => '12345',
            'cliente' => 'juan000'
        ];

        $usuario = $request->usuario;
        $clave = $request->clave;

        if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $clave) {

            session(['usuario' => $usuario]);

            
            if ($usuario === 'admin') {
                return redirect()->route('admi.panel');
            } else {
                return redirect()->route('cliente.panel');
            }

        } else {
            return back()->with('error', 'Usuario o contraseña incorrectos.');
        }
    }

    public function panelAdministrador()
    {
        if (session('usuario') !== 'admin') {
            return redirect()->route('login')->with('error', 'Acceso denegado.');
        }

        $productos = DB::table('productos')
            ->leftJoin('tipos_productos', 'productos.id_tipo', '=', 'tipos_productos.id_tipo')
            ->select('productos.*', 'tipos_productos.nombre_tipo')
            ->get();

        return view('admi.panel', compact('productos'));
    }

    public function panelCliente()
    {
        if (session('usuario') !== 'cliente') {
            return redirect()->route('login')->with('error', 'Acceso denegado.');
        }

        $productos = DB::table('productos')
            ->leftJoin('tipos_productos', 'productos.id_tipo', '=', 'tipos_productos.id_tipo')
            ->select('productos.*', 'tipos_productos.nombre_tipo')
            ->get();

        return view('cliente.panel', compact('productos'));
    }

    public function salir()
    {
        session()->forget('usuario');
        return redirect()->route('login');
    }
}
