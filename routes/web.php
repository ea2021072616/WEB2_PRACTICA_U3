<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DocenteDashboardController;
use App\Http\Controllers\EstudianteDashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\AtencionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'upt.email'])->group(function () {
    // RUTA TEMPORAL PARA DEBUG - ELIMINAR DESPUÉS
    Route::get('/verificar-rol', function () {
        $user = auth()->user();
        return response()->json([
            'nombre' => $user->name,
            'email' => $user->email,
            'rol' => $user->role,
            'es_admin' => $user->isAdmin(),
            'es_docente' => $user->isDocente(),
            'es_estudiante' => $user->isEstudiante(),
        ]);
    });
    
    // Redirigir dashboard según el rol
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isDocente()) {
            return redirect()->route('docente.dashboard');
        } else {
            return redirect()->route('estudiante.dashboard');
        }
    })->name('dashboard');
    
    // Rutas para Administrador
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/reportes', [AdminDashboardController::class, 'reportes'])->name('admin.reportes');
        Route::resource('estudiantes', EstudianteController::class);
        Route::resource('docentes', DocenteController::class);
        Route::resource('temas', TemaController::class);
    });
    
    // Rutas para Docente y Admin (gestión de atenciones)
    Route::middleware(['role:docente,admin'])->group(function () {
        Route::get('/docente/dashboard', [DocenteDashboardController::class, 'index'])->name('docente.dashboard');
        Route::resource('atenciones', AtencionController::class)->except(['destroy']);
    });
    
    // Solo admin puede eliminar atenciones
    Route::middleware(['role:admin'])->group(function () {
        Route::delete('/atenciones/{atencion}', [AtencionController::class, 'destroy'])->name('atenciones.destroy');
    });
    
    // Rutas para Estudiante
    Route::middleware(['role:estudiante'])->group(function () {
        Route::get('/estudiante/dashboard', [EstudianteDashboardController::class, 'index'])->name('estudiante.dashboard');
        Route::get('/mis-atenciones', [AtencionController::class, 'index'])->name('estudiante.atenciones');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
