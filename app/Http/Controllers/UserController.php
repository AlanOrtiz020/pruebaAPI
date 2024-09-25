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
}
