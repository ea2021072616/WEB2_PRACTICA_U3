<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    public function run(): void
    {
        $temas = [
            'Consejería en asuntos relacionados con el plan de estudios',
            'Consejería en asuntos relacionados con el desarrollo profesional',
            'Consejería en asuntos relacionados con la inserción laboral',
            'Asuntos Académicos del Proceso de Plan de Tesis o Tesis',
            'Otros'
        ];

        foreach ($temas as $tema) {
            Tema::create(['nombre' => $tema]);
        }
    }
}
