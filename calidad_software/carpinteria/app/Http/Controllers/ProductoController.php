<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    
    public function index()
    {
       
        $productos = DB::table('productos')
            ->leftJoin('tipos_productos', 'productos.id_tipo', '=', 'tipos_productos.id_tipo')
            ->select('productos.*', 'tipos_productos.nombre_tipo')
            ->orderBy('id_producto', 'desc')
            ->get();

        return view('admi.panel', compact('productos'));
    }

   
    public function create()
    {
        $tipos = DB::table('tipos_productos')->get();
        return view('admi.crear', compact('tipos'));
    }

   
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:100',
            'material' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:255',
            'id_tipo' => 'required|integer'
        ]);

        
        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', ' Producto creado correctamente.');
    }

    
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipos = DB::table('tipos_productos')->get();

        return view('admi.editar', compact('producto', 'tipos'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'material' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:255',
            'id_tipo' => 'required|integer'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', ' Producto actualizado correctamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admi.ver', compact('producto'));
    }
    
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', ' Producto eliminado correctamente.');
    }
}
