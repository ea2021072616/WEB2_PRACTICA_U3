<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstudianteDashboardController extends Controller
{
    public function index()
    {
        $estudiante = Auth::user()->estudiante;

        // Si el usuario no tiene estudiante asociado, redirigir
        if (!$estudiante) {
            return redirect()->route('dashboard')->with('error', 'No tienes un perfil de estudiante asociado.');
        }

        $stats = [
            'total_atenciones' => Atencion::where('estudiante_id', $estudiante->id)->count(),
            'atenciones_semestre' => Atencion::where('estudiante_id', $estudiante->id)
                ->where('semestre', now()->year . '-' . (now()->month <= 6 ? '1' : '2'))
                ->count(),
            'docentes_consultados' => Atencion::where('estudiante_id', $estudiante->id)
                ->distinct('docente_id')
                ->count('docente_id'),
        ];

        $atencionesPorTema = Atencion::where('estudiante_id', $estudiante->id)
            ->join('temas', 'atenciones.tema_id', '=', 'temas.id')
            ->select('temas.nombre', DB::raw('count(*) as total'))
            ->groupBy('temas.id', 'temas.nombre')
            ->orderBy('total', 'desc')
            ->get();

        $atenciones_recientes = Atencion::where('estudiante_id', $estudiante->id)
            ->with(['docente', 'tema'])
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();

        return view('dashboards.estudiante', compact('stats', 'atencionesPorTema', 'atenciones_recientes'));
    }
}
