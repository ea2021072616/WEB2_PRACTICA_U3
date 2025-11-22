<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::latest()->paginate(10);
        return view('temas.index', compact('temas'));
    }

    public function create()
    {
        return view('temas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
        ]);

        Tema::create($validated);
        return redirect()->route('temas.index')->with('success', 'Tema creado exitosamente');
    }

    public function show(Tema $tema)
    {
        return view('temas.show', compact('tema'));
    }

    public function edit(Tema $tema)
    {
        return view('temas.edit', compact('tema'));
    }

    public function update(Request $request, Tema $tema)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
        ]);

        $tema->update($validated);
        return redirect()->route('temas.index')->with('success', 'Tema actualizado exitosamente');
    }

    public function destroy(Tema $tema)
    {
        $tema->delete();
        return redirect()->route('temas.index')->with('success', 'Tema eliminado exitosamente');
    }
}
