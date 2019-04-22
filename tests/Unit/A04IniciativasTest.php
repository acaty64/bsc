<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class A04IniciativasTest extends TestCase
{
	use RefreshDatabase;

    public function testCRUDIniciativa()
    {
    	// CREATE
    	$iniciativa = $this->defaultUser();
    	$this->actingAs($iniciativa);
        $request = [
        	'winiciativa' => 'Iniciativa del mes',
            'inductor' => 'informes',
            'indicador' => 'informe(s)',
            'meta' => 2,
            'year' => 2019,
            'incidencia' => 50,
            'objetivo_id' => 2
        ];

        $response = $this->post(route('iniciativas.store'), $request);
// dd($response);
        $iniciativa_id = $response->original['iniciativa_id'];
        $response->assertStatus(200);

        $this->assertDatabaseHas('iniciativas', $request);

        // UPDATE
        $newRequest = [
        	'id' => $iniciativa_id,
            'winiciativa' => 'Iniciativa del mes modificada',
            'inductor' => 'informes',
            'indicador' => 'informe(s)',
            'meta' => 5,
            'year' => 2019,
            'incidencia' => 100,
            'objetivo_id' => 2
        ];

        $response = $this->post(route('iniciativas.update'), $newRequest);

        $response->assertStatus(200);

        unset($newRequest['password']);
        $this->assertDatabaseHas('iniciativas', $newRequest);

        // DESTROY
        $response = $this->delete("iniciativas/destroy/{$iniciativa_id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('iniciativas', [ 'id'=>$iniciativa_id ]);

    }
}
