<?php

namespace Tests\Unit;

use DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A05AvancesTest extends TestCase
{
	/** @test */
    public function AddAvancesTest()
    {
    	Artisan::call('db:seed');

    	// Check STORE
    	$request = [
		      'iniciativa_id' => 1,
		      'user_id' => 1,
		      'ejecutado'     => 2,
		      'mes'     => 3,
		      'finductor'     => 'aewviandaewfvaivnfajweionv'
		    ];

        $response = $this->post("api/avances/store",$request);
// dd($response);
    	$response->assertStatus(200);

    	// Check database
    	$this->assertDatabaseHas('avances', $request);

    	//Check UPDATE
    	$request = [
    			'id' => 1,
		      	'iniciativa_id' => 1,
		      	'user_id' => 1,
		      	'ejecutado'     => 3,
		      	'mes'     => 5,
		      	'finductor'     => 'aewviandaewfvaivnfajweionv'
		    ];    	

        $response = $this->post("api/avances/update",$request);
    	$response->assertStatus(200);

    	// Check database
    	$this->assertDatabaseHas('avances', $request);

    }
}
