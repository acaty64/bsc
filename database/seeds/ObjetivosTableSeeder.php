<?php

use App\Objetivo;
use Illuminate\Database\Seeder;

class ObjetivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Objetivo::create([
                	'wobjetivo' => 'Estudio del Logro del Perfil',
                    'incidencia' => 50,
                    'perspectiva_id' => 1,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Ingresantes',
                    'incidencia' => 50,
                    'perspectiva_id' => 1,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Gestión Administrativa-Financiera',
                    'incidencia' => 50,
                    'perspectiva_id' => 2,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Sostenibilidad',
                    'incidencia' => 50,
                    'perspectiva_id' => 2,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Modelo de Calidad',
                    'incidencia' => 50,
                    'perspectiva_id' => 3,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Formación Continua',
                    'incidencia' => 50,
                    'perspectiva_id' => 3,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Docentes con Experiencia en su Especialidad',
                    'incidencia' => 50,
                    'perspectiva_id' => 4,
                ]);
        Objetivo::create([
                	'wobjetivo' => 'Soporte Tecnológico',
                    'incidencia' => 50,
                    'perspectiva_id' => 4,
                ]);
    }
}
