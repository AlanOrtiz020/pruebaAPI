<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $ListUser = User::all();
        //return response()->json($user);
        //return response()->json(User:: all());
        return compact('ListUser');
    }
    public function store(UserRequest $request)
    {
        /*
        nombre
        correo
        password
        password_confirmation
        */
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado con éxito',
            'data' => $user
        ], 201);
    }

    public function show($id){
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        return compact('user');
    }

    public function update(UserRequest $request, $id){

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404); // 404 Not Found
        }
//dd($request->all());
        $user->name = $request->input('nombre');
        $user->email = $request->input('correo');
        $user->password = bcrypt($request->input('password')); // Encripta la contraseña
        $user->save();

        //$user =User::where('id',$id)->update([
        //    'name' => $request->nombre,
        //    'email' => $request->correo,
        //    'password' => Hash::make($request->password),
        //]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado con éxito',
            'data' => $user
        ], 201);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}
