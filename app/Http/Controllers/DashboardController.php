<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalEstudiantes = Estudiante::count();
        $totalDocentes = Docente::count();
        $totalTemas = Tema::count();
        $totalAtenciones = Atencion::count();
        
        $atencionesPorSemestre = Atencion::select('semestre', DB::raw('count(*) as total'))
            ->groupBy('semestre')
            ->orderBy('semestre', 'desc')
            ->get();
            
        $atencionesPorDocente = Atencion::select('docente_id', DB::raw('count(*) as total'))
            ->with('docente')
            ->groupBy('docente_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
            
        $atencionesPorTema = Atencion::select('tema_id', DB::raw('count(*) as total'))
            ->with('tema')
            ->groupBy('tema_id')
            ->orderBy('total', 'desc')
            ->get();
            
        $recientesAtenciones = Atencion::with(['docente', 'estudiante', 'tema'])
            ->latest()
            ->limit(5)
            ->get();
        
        return view('dashboard', compact(
            'totalEstudiantes',
            'totalDocentes',
            'totalTemas',
            'totalAtenciones',
            'atencionesPorSemestre',
            'atencionesPorDocente',
            'atencionesPorTema',
            'recientesAtenciones'
        ));
    }
    
    public function reportes(Request $request)
    {
        $query = Atencion::with(['docente', 'estudiante', 'tema']);
        
        if ($request->semestre) {
            $query->where('semestre', $request->semestre);
        }
        if ($request->docente_id) {
            $query->where('docente_id', $request->docente_id);
        }
        if ($request->tema_id) {
            $query->where('tema_id', $request->tema_id);
        }
        if ($request->fecha_desde) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }
        
        $atenciones = $query->latest()->get();
        $docentes = Docente::all();
        $temas = Tema::all();
        $semestres = Atencion::select('semestre')->distinct()->orderBy('semestre', 'desc')->pluck('semestre');
        
        return view('reportes', compact('atenciones', 'docentes', 'temas', 'semestres'));
    }
}
