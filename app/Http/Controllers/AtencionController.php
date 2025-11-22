<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AtencionController extends Controller
{
    public function index(Request $request)
    {
        $query = Atencion::with(['docente', 'estudiante', 'tema']);
        
        // Filtrar según rol del usuario
        $user = auth()->user();
        if ($user->isDocente()) {
            $query->where('docente_id', $user->docente->id);
        } elseif ($user->isEstudiante()) {
            $query->where('estudiante_id', $user->estudiante->id);
        }
        
        if ($request->semestre) {
            $query->where('semestre', $request->semestre);
        }
        if ($request->fecha_desde) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }
        
        $atenciones = $query->latest()->paginate(10);
        return view('atenciones.index', compact('atenciones'));
    }

    public function create()
    {
        $docentes = Docente::all();
        $estudiantes = Estudiante::all();
        $temas = Tema::all();
        return view('atenciones.create', compact('docentes', 'estudiantes', 'temas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'semestre' => 'required|string|max:20',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'docente_id' => 'required|exists:docentes,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'tema_id' => 'required|exists:temas,id',
            'consulta' => 'required|string',
            'descripcion' => 'required|string',
            'evidencia' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            $validated['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        Atencion::create($validated);
        return redirect()->route('atenciones.index')->with('success', 'Atención registrada exitosamente');
    }

    public function show(Atencion $atencion)
    {
        $atencion->load(['docente', 'estudiante', 'tema']);
        return view('atenciones.show', compact('atencion'));
    }

    public function edit(Atencion $atencion)
    {
        $docentes = Docente::all();
        $estudiantes = Estudiante::all();
        $temas = Tema::all();
        return view('atenciones.edit', compact('atencion', 'docentes', 'estudiantes', 'temas'));
    }

    public function update(Request $request, Atencion $atencion)
    {
        $validated = $request->validate([
            'semestre' => 'required|string|max:20',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'docente_id' => 'required|exists:docentes,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'tema_id' => 'required|exists:temas,id',
            'consulta' => 'required|string',
            'descripcion' => 'required|string',
            'evidencia' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            if ($atencion->evidencia) {
                Storage::disk('public')->delete($atencion->evidencia);
            }
            $validated['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        $atencion->update($validated);
        return redirect()->route('atenciones.index')->with('success', 'Atención actualizada exitosamente');
    }

    public function destroy(Atencion $atencion)
    {
        if ($atencion->evidencia) {
            Storage::disk('public')->delete($atencion->evidencia);
        }
        $atencion->delete();
        return redirect()->route('atenciones.index')->with('success', 'Atención eliminada exitosamente');
    }
}
