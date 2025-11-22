<?php

namespace Database\Seeders;

use App\Models\Atencion;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Tema;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AtencionSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = Estudiante::all();
        $docentes = Docente::all();
        $temas = Tema::all();

        $atenciones = [
            [
                'semestre' => '2024-1',
                'fecha' => Carbon::create(2024, 3, 15),
                'hora' => '09:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con el plan de estudios')->first(),
                'consulta' => 'Deseo información sobre los cursos electivos disponibles para el siguiente ciclo académico y cuáles son los más recomendados para mi especialidad.',
                'descripcion' => 'Se orientó al estudiante sobre los cursos electivos disponibles, sus contenidos y la carga académica. Se recomendó priorizar cursos relacionados con su área de especialización.',
            ],
            [
                'semestre' => '2024-1',
                'fecha' => Carbon::create(2024, 3, 20),
                'hora' => '10:30',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con el desarrollo profesional')->first(),
                'consulta' => 'Me gustaría participar en proyectos de investigación pero no sé cómo empezar ni qué requisitos necesito cumplir.',
                'descripcion' => 'Se explicó el proceso para participar en grupos de investigación, se presentaron las líneas de investigación activas y se coordinó una reunión con el director de investigación.',
            ],
            [
                'semestre' => '2024-1',
                'fecha' => Carbon::create(2024, 4, 5),
                'hora' => '14:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con la inserción laboral')->first(),
                'consulta' => 'Necesito orientación sobre cómo preparar mi CV y carta de presentación para postular a prácticas profesionales.',
                'descripcion' => 'Se revisó el CV del estudiante, se brindaron recomendaciones de mejora y se compartieron plantillas profesionales. Se coordinó con la oficina de empleabilidad.',
            ],
            [
                'semestre' => '2024-1',
                'fecha' => Carbon::create(2024, 4, 12),
                'hora' => '11:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Asuntos Académicos del Proceso de Plan de Tesis o Tesis')->first(),
                'consulta' => 'Tengo dudas sobre la estructura del plan de tesis y los requisitos formales que debe cumplir según el reglamento.',
                'descripcion' => 'Se explicó detalladamente la estructura del plan de tesis, se revisó el reglamento vigente y se proporcionó el formato oficial. Se agendó seguimiento.',
            ],
            [
                'semestre' => '2024-1',
                'fecha' => Carbon::create(2024, 4, 18),
                'hora' => '15:30',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Otros')->first(),
                'consulta' => 'Necesito asesoría sobre procedimientos administrativos para solicitar convalidación de cursos de otra universidad.',
                'descripcion' => 'Se explicó el proceso de convalidación, documentos requeridos y plazos. Se derivó a la oficina de registros académicos para iniciar el trámite.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 8, 10),
                'hora' => '09:30',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con el plan de estudios')->first(),
                'consulta' => 'Estoy considerando cambiar de especialidad y quisiera saber qué implicancias tendría en mi plan de estudios.',
                'descripcion' => 'Se analizó el plan de estudios actual y el de la nueva especialidad. Se identificaron cursos convalidables y se calculó el tiempo adicional requerido.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 8, 22),
                'hora' => '13:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con el desarrollo profesional')->first(),
                'consulta' => 'Quiero saber sobre oportunidades de intercambio estudiantil y becas internacionales disponibles.',
                'descripcion' => 'Se presentaron los convenios vigentes, requisitos académicos y de idiomas. Se compartió información sobre becas disponibles y proceso de postulación.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 9, 5),
                'hora' => '10:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con la inserción laboral')->first(),
                'consulta' => 'Me ofrecieron una práctica pero no estoy seguro si cumple con los requisitos de prácticas pre-profesionales.',
                'descripcion' => 'Se revisó la oferta laboral, se verificó el cumplimiento de requisitos según reglamento y se orientó sobre el proceso de formalización.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 9, 18),
                'hora' => '16:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Asuntos Académicos del Proceso de Plan de Tesis o Tesis')->first(),
                'consulta' => 'Necesito cambiar de asesor de tesis por incompatibilidad de horarios y línea de investigación.',
                'descripcion' => 'Se analizó la situación, se revisó el reglamento de cambio de asesor y se inició el proceso administrativo correspondiente.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 10, 8),
                'hora' => '11:30',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con el desarrollo profesional')->first(),
                'consulta' => 'Quiero participar en eventos académicos externos pero desconozco los mecanismos de apoyo institucional.',
                'descripcion' => 'Se informó sobre los programas de apoyo para eventos académicos, requisitos para solicitar financiamiento parcial y proceso de justificación.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 10, 15),
                'hora' => '14:30',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Otros')->first(),
                'consulta' => 'Tengo problemas personales que están afectando mi rendimiento académico y necesito orientación.',
                'descripcion' => 'Se brindó escucha activa y contención. Se derivó al servicio de bienestar estudiantil para apoyo psicológico especializado.',
            ],
            [
                'semestre' => '2024-2',
                'fecha' => Carbon::create(2024, 11, 5),
                'hora' => '09:00',
                'estudiante' => $estudiantes->random(),
                'docente' => $docentes->random(),
                'tema' => $temas->where('nombre', 'Consejería en asuntos relacionados con la inserción laboral')->first(),
                'consulta' => 'Quisiera información sobre certificaciones profesionales que complementen mi formación académica.',
                'descripcion' => 'Se identificaron certificaciones relevantes para su perfil, se compartieron recursos de preparación y se informó sobre programas de certificación institucionales.',
            ],
        ];

        foreach ($atenciones as $atencionData) {
            Atencion::create([
                'semestre' => $atencionData['semestre'],
                'fecha' => $atencionData['fecha'],
                'hora' => $atencionData['hora'],
                'estudiante_id' => $atencionData['estudiante']->id,
                'docente_id' => $atencionData['docente']->id,
                'tema_id' => $atencionData['tema']->id,
                'consulta' => $atencionData['consulta'],
                'descripcion' => $atencionData['descripcion'],
            ]);
        }
    }
}
