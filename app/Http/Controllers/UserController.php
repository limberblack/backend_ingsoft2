<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::all();	
        return response()->json(['data' => $user], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
            'cedula'     => 'required|string|min:10|max:10|unique:users,cedula',
            'name'     => 'required|string|max:200',
            'lastname'     => 'required|string|max:200',
            'celular'     => 'required|string|min:10|max:10',
            'direccion'     => 'required|string|max:200',
            'email'     => 'required|string|email',
        ]);
        
        $user = User::create($request->all());
	
        return response()->json(['data'=>$user, 'message' => 'User Creado'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);

        if(!$user)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        return response()->json(['data'=>$user, 'message' => 'Usuario encontrado'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);

        if(!$user)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        $request->validate([
            'name'     => 'required|string|max:200',
            'lastname'     => 'required|string|max:200',
            'celular'     => 'required|string|min:10|max:10',
            'direccion'     => 'required|string|max:200',
            'email'     => 'required|string|email',
        ]);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->celular = $request->celular;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
			
		$user->save();

        return response()->json(['data'=>$user,'message' => 'Usuario actualizado'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);

        if(!$user)
		{
			return response()->json(
				['errors'=>array(['code'=>404,
				'message'=>'No se encuentra un usuario con ese identificador.',
				'identificador'=>$id
			])],404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario Eliminado'], 200);
    }
}
