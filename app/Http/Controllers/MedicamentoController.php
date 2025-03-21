<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MedicamentoController extends Controller
{
    // Mostrar todos los medicamentos


public function generarPDF()
{
    $medicamentos = Medicamento::all(); // Obtiene todos los medicamentos

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
        $medicamentos = Medicamento::all();
        return view('medicamentos.index', compact('medicamentos'));
    }

    // Mostrar formulario de creación
    public function create(): View
    {
        return view('medicamentos.create');
    }

    // Guardar un nuevo medicamento
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'horarios' => 'nullable|array', // Horarios como un array
        ]);

        Medicamento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'horarios' => $request->horarios ? json_encode($request->horarios) : null, // Guardar como JSON
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id): View
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamentos.edit', compact('medicamento'));
    }

    // Actualizar un medicamento
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
            'horarios' => $request->horarios ? json_encode($request->horarios) : null,
        ]);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    // Eliminar un medicamento
    public function destroy($id): RedirectResponse
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();
    
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }

    // Descargar historial de medicamentos en CSV
    public function descargarHistorial(): StreamedResponse
    {
        $medicamentos = Medicamento::all();

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
                    $medicamento->horarios ? implode(', ', json_decode($medicamento->horarios)) : 'No asignado',
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="historial_medicamentos.csv"');

        return $response;
    }
}
