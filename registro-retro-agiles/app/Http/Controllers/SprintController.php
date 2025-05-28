<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Corregir importación
use App\Models\Sprint;

class SprintController extends Controller
{
    // Listar todos los sprints
    public function index()
    {
        $sprints = Sprint::all(); // <-- Corregir variable ($paint → Sprint)
        return view('sprints.index', ['sprints' => $sprints]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('sprints.create');
    }

    // Guardar nuevo sprint
    public function store(Request $request)
    {
        // Validación corregida (usar [] en lugar de {})
        $request->validate([
            'nombre' => 'required|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio'
        ]);

        Sprint::create($request->all());
        
        return redirect('/sprints')->with('success', 'Sprint creado!');
    }

        public function update(Request $request, Sprint $sprint)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio'
        ]);

        $sprint->update($request->all());
        return redirect()->route('sprints.index')->with('success', 'Sprint actualizado!');
    }
            public function show($id)
    {
        $sprint = Sprint::findOrFail($id);
        $retroItems = $sprint->retroItems; // Carga los ítems relacionados

        return view('sprints.show', compact('sprint', 'retroItems'));
    }


}