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

        // ========== ESTADÍSTICAS PARA GRÁFICOS ==========

        // Resumen general
        $totalAtenciones = Atencion::count();
        $totalEstudiantes = Estudiante::count();
        $totalDocentes = Docente::count();

        // Estudiantes atendidos (únicos)
        $estudiantesAtendidos = Atencion::distinct('estudiante_id')->count('estudiante_id');

        // Atenciones por mes (últimos 6 meses)
        $atencionesPorMes = Atencion::select(
                DB::raw('YEAR(fecha) as year'),
                DB::raw('MONTH(fecha) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('fecha')
            ->where('fecha', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function($item) {
                $meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                return [
                    'label' => $meses[$item->month] . ' ' . $item->year,
                    'total' => $item->total
                ];
            });

        // Atenciones por día de la semana
        $atencionesPorDia = Atencion::select(
                DB::raw('DAYOFWEEK(fecha) as dia'),
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('fecha')
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->map(function($item) {
                $dias = ['', 'Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
                return [
                    'label' => $dias[$item->dia] ?? 'N/A',
                    'total' => $item->total
                ];
            });

        // Top 5 temas más consultados
        $topTemas = Atencion::join('temas', 'atenciones.tema_id', '=', 'temas.id')
            ->select('temas.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('temas.id', 'temas.nombre')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Top 5 docentes con más atenciones
        $topDocentes = Atencion::join('docentes', 'atenciones.docente_id', '=', 'docentes.id')
            ->select('docentes.nombres', 'docentes.apellidos', DB::raw('COUNT(*) as total'))
            ->groupBy('docentes.id', 'docentes.nombres', 'docentes.apellidos')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Atenciones por semestre
        $atencionesPorSemestre = Atencion::select('semestre', DB::raw('COUNT(*) as total'))
            ->whereNotNull('semestre')
            ->groupBy('semestre')
            ->orderBy('semestre', 'desc')
            ->limit(6)
            ->get();

        // Promedio de atenciones por docente
        $promedioAtencionesDocente = $totalDocentes > 0 ? round($totalAtenciones / $totalDocentes, 1) : 0;

        // Porcentaje de estudiantes atendidos
        $porcentajeEstudiantesAtendidos = $totalEstudiantes > 0 ? round(($estudiantesAtendidos / $totalEstudiantes) * 100, 1) : 0;

        return view('dashboards.reportes', compact(
            'atenciones',
            'docentes',
            'temas',
            'totalAtenciones',
            'totalEstudiantes',
            'totalDocentes',
            'estudiantesAtendidos',
            'atencionesPorMes',
            'atencionesPorDia',
            'topTemas',
            'topDocentes',
            'atencionesPorSemestre',
            'promedioAtencionesDocente',
            'porcentajeEstudiantesAtendidos'
        ));
    }
}
