<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Estudiante;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocenteDashboardController extends Controller
{
    public function index()
    {
        $docente = Auth::user()->docente;

        // Si el usuario no tiene docente asociado, redirigir
        if (!$docente) {
            return redirect()->route('dashboard')->with('error', 'No tienes un perfil de docente asociado.');
        }

        $stats = [
            'total_atenciones' => Atencion::where('docente_id', $docente->id)->count(),
            'atenciones_mes' => Atencion::where('docente_id', $docente->id)
                ->whereMonth('fecha', now()->month)
                ->whereYear('fecha', now()->year)
                ->count(),
            'estudiantes_atendidos' => Atencion::where('docente_id', $docente->id)
                ->distinct('estudiante_id')
                ->count('estudiante_id'),
        ];

        $atencionesPorTema = Atencion::where('docente_id', $docente->id)
            ->join('temas', 'atenciones.tema_id', '=', 'temas.id')
            ->select('temas.nombre', DB::raw('count(*) as total'))
            ->groupBy('temas.id', 'temas.nombre')
            ->orderBy('total', 'desc')
            ->get();

        $atenciones_recientes = Atencion::where('docente_id', $docente->id)
            ->with(['estudiante', 'tema'])
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();

        return view('dashboards.docente', compact('stats', 'atencionesPorTema', 'atenciones_recientes'));
    }
}
