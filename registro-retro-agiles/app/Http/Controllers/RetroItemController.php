<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\RetroItem;
use Illuminate\Http\Request;

class RetroItemController extends Controller
{
    // Mostrar formulario de creación
    public function create(Sprint $sprint)
    {
        return view('retro-items.create', [
            'sprint' => $sprint
        ]);
    }

    // Guardar nuevo ítem
    public function store(Request $request, Sprint $sprint)
    {
        $request->validate([
            'categoria' => 'required|in:positivo,negativo,accion',
            'descripcion' => 'required|string|max:500',
            'fecha_revision' => 'nullable|date'
        ]);

        $sprint->retroItems()->create($request->all());

        return redirect()->route('sprints.show', $sprint->id)
            ->with('success', 'Ítem agregado correctamente');
    }

    // Eliminar ítem
    public function destroy(RetroItem $retroItem)
    {
        $retroItem->delete();
        return back()->with('success', 'Ítem eliminado');
    }

    // Mostrar formulario de edición
    public function edit(RetroItem $retroItem)
    {
        return view('retro-items.edit', compact('retroItem'));
    }

    // Actualizar ítem
    public function update(Request $request, RetroItem $retroItem)
    {
        $request->validate([
            'categoria' => 'required|in:positivo,negativo,accion',
            'descripcion' => 'required|string|max:500',
            'fecha_revision' => 'nullable|date'
        ]);

        $retroItem->update($request->all());

        return redirect()->route('sprints.show', $retroItem->sprint_id)
            ->with('success', 'Ítem actualizado correctamente');
    }

    // ✅ IMPORTAR ACCIONES DEL SPRINT ANTERIOR
    public function importarAcciones(Sprint $sprint)
    {
        $anterior = Sprint::where('fecha_fin', '<', $sprint->fecha_inicio)
                          ->orderBy('fecha_fin', 'desc')
                          ->first();

        if ($anterior) {
            $acciones = $anterior->retroItems()->where('categoria', 'accion')->get();

            foreach ($acciones as $accion) {
                $sprint->retroItems()->create([
                    'categoria' => 'accion',
                    'descripcion' => $accion->descripcion,
                    'fecha_revision' => null
                ]);
            }

            return back()->with('success', 'Acciones del sprint anterior importadas correctamente.');
        }

        return back()->with('error', 'No se encontró sprint anterior.');
    }
}
