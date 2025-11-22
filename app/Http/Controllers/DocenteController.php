<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('user')->latest()->paginate(10);
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('docente')->get();
        return view('docentes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:docentes',
            'apellidos' => 'required|string|max:150',
            'nombres' => 'required|string|max:100',
        ]);

        Docente::create($validated);
        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente');
    }

    public function show(Docente $docente)
    {
        $docente->load('user', 'atenciones');
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        $users = User::whereDoesntHave('docente')->orWhere('id', $docente->user_id)->get();
        return view('docentes.edit', compact('docente', 'users'));
    }

    public function update(Request $request, Docente $docente)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:docentes,user_id,' . $docente->id,
            'apellidos' => 'required|string|max:150',
            'nombres' => 'required|string|max:100',
        ]);

        $docente->update($validated);
        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente');
    }
}
