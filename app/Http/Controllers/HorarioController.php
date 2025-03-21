<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class HorarioController extends Controller
{
    public function index(): JsonResponse
    {
        $horarios = Horario::where('user_id', Auth::id())->get();
        return response()->json($horarios);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'hora' => 'required|date_format:H:i',
            'frecuencia' => 'required|string|max:100',
        ]);

        $horario = Horario::create([
            'medicamento_id' => $request->medicamento_id,
            'hora' => $request->hora,
            'frecuencia' => $request->frecuencia,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['mensaje' => 'Horario guardado', 'horario' => $horario]);
    }
}