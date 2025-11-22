<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = 'atenciones';
    
    protected $fillable = [
        'semestre', 'fecha', 'hora', 'docente_id', 'estudiante_id',
        'tema_id', 'consulta', 'descripcion', 'evidencia'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
