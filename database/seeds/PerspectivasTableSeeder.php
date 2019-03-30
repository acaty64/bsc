<?php

use App\Perspectiva;
use Illuminate\Database\Seeder;

class PerspectivasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perspectiva::create([
                    'wperspectiva' => 'Clientes'
                ]);
        Perspectiva::create([
                    'wperspectiva' => 'Financiera'
                ]);
        Perspectiva::create([
                	'wperspectiva' => 'Procesos Internos'
                ]);
        Perspectiva::create([
                	'wperspectiva' => 'Aprendizaje y Crecimiento'
                ]);
    }
}
