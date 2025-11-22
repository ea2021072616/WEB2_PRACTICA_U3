<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Atencion;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_estudiantes' => Estudiante::count(),
            'total_docentes' => Docente::count(),
            'total_atenciones' => Atencion::count(),
            'total_temas' => Tema::count(),
        ];

        $atencionesPorSemestre = Atencion::select('semestre', DB::raw('count(*) as total'))
            ->groupBy('semestre')
            ->orderBy('semestre', 'desc')
            ->get();

        $atencionesPorDocente = Atencion::join('docentes', 'atenciones.docente_id', '=', 'docentes.id')
            ->select('docentes.nombres', 'docentes.apellidos', DB::raw('count(*) as total'))
            ->groupBy('docentes.id', 'docentes.nombres', 'docentes.apellidos')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $atencionesPorTema = Atencion::join('temas', 'atenciones.tema_id', '=', 'temas.id')
            ->select('temas.nombre', DB::raw('count(*) as total'))
            ->groupBy('temas.id', 'temas.nombre')
            ->orderBy('total', 'desc')
            ->get();

        $atenciones_recientes = Atencion::with(['estudiante', 'docente', 'tema'])
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();

        return view('dashboards.admin', compact('stats', 'atencionesPorSemestre', 'atencionesPorDocente', 'atencionesPorTema', 'atenciones_recientes'));
    }

    public function reportes(Request $request)
    {
        $query = Atencion::with(['estudiante', 'docente', 'tema']);

        if ($request->filled('semestre')) {
            $query->where('semestre', $request->semestre);
        }

        if ($request->filled('docente_id')) {
            $query->where('docente_id', $request->docente_id);
        }

        if ($request->filled('tema_id')) {
            $query->where('tema_id', $request->tema_id);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $atenciones = $query->orderBy('fecha', 'desc')->paginate(20);
        $docentes = Docente::all();
        $temas = Tema::all();

        return view('dashboards.reportes', compact('atenciones', 'docentes', 'temas'));
    }
}
