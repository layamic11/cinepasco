<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Función para el INICIO DE SESIÓN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],   
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $usuario = Auth::user();

            return response()->json([
                'status' => 'success',
                'mensaje' => '¡Bienvenido ' . $usuario->name . '!',
                'rol' => $usuario->rol
            ]);
        }

        return response()->json([
            'status' => 'error',
            'mensaje' => 'Las credenciales no coinciden con nuestros registros.'
        ], 401);
    }

    // Función para el REGISTRO NUEVO
    public function register(Request $request)
    {
        // 1. Validamos los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // 2. Creamos al usuario de forma segura
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'cliente' 
        ]);

        // 3. Lo autenticamos automáticamente para que no tenga que volver a escribir todo
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'mensaje' => '¡Cuenta creada con éxito! Bienvenido ' . $user->name,
            'rol' => $user->rol
        ]);
    }
}