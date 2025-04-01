<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class DosisController extends Controller
{
    public function index(): JsonResponse
    {
        $dosis = Dosis::with('medicamento') // Cargar la relación
        ->whereHas('medicamento', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->get();

    return response()->json($dosis);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer',
            'hora' => 'required|date_format:H:i',
        ]);

        $dosis = Dosis::create([
            'medicamento_id' => $request->medicamento_id,
            'cantidad' => $request->cantidad,
            'hora' => $request->hora,
        ]);

        return response()->json(['mensaje' => 'Dosis registrada', 'dosis' => $dosis]);
    }
}