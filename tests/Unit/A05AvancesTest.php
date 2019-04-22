<?php

namespace Tests\Unit;

use DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A05AvancesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function AddAvancesTest()
    {
    	// Check STORE
    	$request = [
        		'id' => 0,
                'user_id' => 1,
                'iniciativa_id' => 1,
                'ejecutado' => 2,
                'mes'     => 3,
                'year'  => 2019,
                'warchivo'     => 'prueba.pdf',
                'archivo'     => 'avances/aewviandaewfvaivnfajweionv.pdf',
            ];

        $response = $this->post("api/avances/store", $request);

        $response->assertStatus(200);

        // Check database
        unset($request['id']);
        $this->assertDatabaseHas('avances', $request);

        //Check UPDATE in AvanceController@store
        $request = [
                'id' => 1,
		      	'iniciativa_id' => 1,
		      	'user_id' => 1,
		      	'ejecutado'     => 3,
		      	// 'mes'     => 5,
                'year'  => 2019,
                'archivo'     => 'avances/xxaewviandaewfvaivnfajweionv.pdf',
                'warchivo'     => 'prueba.pdf',
		    ];    	

        $response = $this->post("api/avances/store",$request);
    	$response->assertStatus(200);

    	// Check database
    	$this->assertDatabaseHas('avances', $request);

    }
}
