<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class HistorialController extends Controller
{
    public function index(): JsonResponse
    {
        $historial = Historial::where('user_id', Auth::id())->get();
        return response()->json($historial);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
        ]);

        $historial = Historial::create([
            'medicamento_id' => $request->medicamento_id,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['mensaje' => 'Registro de historial guardado', 'historial' => $historial]);
    }
}