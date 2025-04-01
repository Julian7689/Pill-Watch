<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MedicamentoController extends Controller
{
    public function generarPDF()
    {
        $medicamentos = Medicamento::all();
        $pdf = PDF::loadView('medicamentos.pdf', compact('medicamentos'));
        return $pdf->stream('historial_medicamentos.pdf');
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, "ID inválido");
        }

        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.show', compact('medicamento'));
    }

    public function index(): View
    {
        $medicamentos = Medicamento::with('horarios')->get(); // Carga los horarios si existen relaciones
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create(): View
    {
        return view('medicamentos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'horarios' => 'nullable|array',
        ]);

        $medicamento = Medicamento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'user_id' => Auth::id(),
        ]);

        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                Horario::create([
                    'medicamento_id' => $medicamento->id,
                    'hora_toma' => $hora,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento registrado correctamente.');
    }

    public function edit($id): View
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.edit', compact('medicamento'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'horarios' => 'nullable|array',
        ]);

        $medicamento = Medicamento::findOrFail($id);
        $medicamento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
        ]);

        $medicamento->horarios()->delete();
        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                Horario::create([
                    'medicamento_id' => $medicamento->id,
                    'hora_toma' => $hora,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->horarios()->delete();
        $medicamento->delete();
    
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }

    public function descargarHistorial(): StreamedResponse
    {
        $medicamentos = Medicamento::with('horarios')->get(); // Cargar horarios para evitar consultas adicionales
    
        $response = new StreamedResponse(function () use ($medicamentos) {
            $handle = fopen('php://output', 'w');
    
            // Escribir encabezados
            fputcsv($handle, ['ID', 'Nombre', 'Cantidad', 'Horarios']);
    
            // Escribir los datos
            foreach ($medicamentos as $medicamento) {
                fputcsv($handle, [
                    $medicamento->id,
                    $medicamento->nombre,
                    $medicamento->cantidad,
                    $medicamento->Horarios->isNotEmpty() 
                        ? implode(', ', $medicamento->Horarios->pluck('hora_toma')->toArray()) 
                        : 'No asignado',
                ]);
            }
    
            fclose($handle);
        });
    
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="historial_medicamentos.csv"');
    
        return $response;
    }
}
