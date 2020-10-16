<?php

namespace App\Http\Controllers;

use App\producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $producto= producto::all();	
        return response()->json(['data' => $producto], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer',
            'precio_c_u' => 'required|regex:/^\d*(\.\d{2})?$/',
            'precio_doce'     => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);
        
        $producto=producto::create($request->all());
	
        return response()->json(['data'=>$producto, 'message' => 'producto Creado'], 201);
    }

    public function show($id)
    {
        $producto=producto::find($id);

        if(!$producto)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        return response()->json(['data'=>$producto, 'message' => 'Usuario encontrado'], 200);
    }

    public function edit(producto $producto)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $producto = producto::find($id);

        if(!$producto)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        $request->validate([
            'name' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'cantidad' => 'nullable|integer'
        ]);
        
        if ( isset($request->name) ) {
            $producto->name = $request->name;
        }
        if ( isset($request->descripcion) ) {
            $producto->descripcion = $request->descripcion;
        }
        if ( isset($request->cantidad) ) {
            $producto->cantidad = $request->cantidad;
        }
        if ( isset($request->precio_c_u) ) {
            $producto->precio_c_u = $request->precio_c_u;
        }
        if ( isset($request->precio_doce) ) {
            $producto->precio_doce = $request->precio_doce;
        }
			
		$producto->save();

        return response()->json(['data'=>$producto,'message' => 'Usuario actualizado'], 200);
    }

    public function destroy($id)
    {
        $producto = producto::find($id);

        if(!$producto)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        $producto->delete();
        return response()->json(['message' => 'Usuario Eliminado'], 200);
    }
}
