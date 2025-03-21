<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class NotificacionController extends Controller
{
    public function index(): JsonResponse
    {
        $notificaciones = Notificacion::where('user_id', Auth::id())->get();
        return response()->json($notificaciones);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
            'tipo' => 'required|string|max:50',
        ]);

        $notificacion = Notificacion::create([
            'mensaje' => $request->mensaje,
            'tipo' => $request->tipo,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['mensaje' => 'Notificación creada', 'notificacion' => $notificacion]);
    }
}

