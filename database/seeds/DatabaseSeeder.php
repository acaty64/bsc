<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerspectivasTableSeeder::class);
        $this->call(ObjetivosTableSeeder::class);
        $this->call(IniciativasTableSeeder::class);
        $this->call(ProgramacionesTableSeeder::class);
        $this->call(AvancesTableSeeder::class);
    }
}
