<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Login de usuario (SPA + Sanctum, sesión basada en cookies).
     */
    public function login(Request $request): JsonResponse
    {
        $credenciales = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // La SPA debe llamar antes a /sanctum/csrf-cookie
        if (!Auth::attempt($credenciales, true)) {
            return response()->json([
                'mensaje' => 'Credenciales incorrectas.',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'mensaje' => 'Inicio de sesión correcto.',
            'usuario' => $request->user(),
        ]);
    }

    /**
     * Devuelve el usuario autenticado (para la SPA).
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'usuario' => $request->user(),
        ]);
    }

    /**
     * Logout: cierra sesión, invalida y regenera token CSRF.
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'mensaje' => 'Sesión cerrada correctamente.',
        ]);
    }
}
