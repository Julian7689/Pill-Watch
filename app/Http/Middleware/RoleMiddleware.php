<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Maneja la solicitud entrante y verifica si el usuario tiene el rol adecuado.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return response()->json(['mensaje' => 'No autenticado'], 401);
        }

        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene el rol necesario
        if ($user->role !== $role) {
            return response()->json(['mensaje' => 'Acceso denegado, no tienes el rol requerido'], 403);
        }

        return $next($request);
    }
}