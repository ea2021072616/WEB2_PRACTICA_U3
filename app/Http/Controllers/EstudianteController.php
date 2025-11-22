<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::latest()->paginate(10);
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:estudiantes',
            'apellidos' => 'required|string|max:150',
            'nombres' => 'required|string|max:100',
        ]);

        Estudiante::create($validated);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente');
    }

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:estudiantes,codigo,' . $estudiante->id,
            'apellidos' => 'required|string|max:150',
            'nombres' => 'required|string|max:100',
        ]);

        $estudiante->update($validated);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente');
    }
}
