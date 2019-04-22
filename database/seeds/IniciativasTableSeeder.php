<?php

use App\Iniciativa;
use Illuminate\Database\Seeder;

class IniciativasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Iniciativa::create([
                	'winiciativa' => 'Monitoreo del mercado laboral.',
                    'inductor' => 'Informe de Monitoreo',
                    'indicador' => 'Informe(s)',
                    'meta' => 2,
                    'year' => 2019,
                    'incidencia' => 100,
                    'objetivo_id' => 1, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Plan de difusión concordado con el plan de Marketing UCSS.',
                    'inductor' => 'Presencia en centros educativos e institutos tecnológicos.',
                    'indicador' => 'Visitas',
                    'meta' => 10,
                    'year' => 2019,
                    'incidencia' => 100 ,
                    'objetivo_id' => 2, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Seguimiento de la ejecución del presupuesto.',
                    'inductor' => 'Revisión Trimestral',
                    'indicador' => 'Revisiones',
                    'meta' => 4,
                    'year' => 2019,
                    'incidencia' => 100 ,
                    'objetivo_id' => 3, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Programa de Tutoría a alumnos',
                    'inductor' => 'Alumnos atendidos',
                    'indicador' => '% ingresantes LIM',
                    'meta' => 25,
                    'year' => 2019,
                    'incidencia' => 100 ,
                    'objetivo_id' => 4, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Plan de reorganización documentaria y administrativa.',
                    'inductor' => 'Personal administrativo capacitado.',
                    'indicador' => '% personal adm. LIM',
                    'meta' => 100,
                    'year' => 2019,
                    'incidencia' => 100 ,
                    'objetivo_id' => 5, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Programa de Formación Continua.',
                    'inductor' => 'Cursos de Formación Continua.',
                    'indicador' => 'cursos',
                    'meta' => 60,
                    'year' => 2019,
                    'incidencia' => 100,
                    'objetivo_id' => 6, 
                ]);
        Iniciativa::create([
                    'winiciativa' => 'Programa de Capacitación Docente a Grado de Maestro.',
                    'inductor' => 'Docentes nombrados con Grado de Maestro',
                    'indicador' => '% docentes nombrados',
                    'meta' => 100,
                    'year' => 2019,
                    'incidencia' => 50 ,
                    'objetivo_id' => 7, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Programa de inducción a la investigación.',
                    'inductor' => 'Artículos científicos',
                    'indicador' => 'artículos',
                    'meta' => 5,
                    'year' => 2019,
                    'incidencia' => 50 ,
                    'objetivo_id' => 7, 
                ]);
        Iniciativa::create([
                	'winiciativa' => 'Plan de Capacitación Docente en el Aula Virtual.',
                    'inductor' => 'Docentes capacitados',
                    'indicador' => '% docentes',
                    'meta' => 50,
                    'year' => 2019,
                    'incidencia' => 100 ,
                    'objetivo_id' => 8, 
                ]);
    }
}
