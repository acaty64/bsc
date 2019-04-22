<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class A03ObjetivosTest extends TestCase
{
	use RefreshDatabase;

    public function testCRUDObjetivos()
    {
    	// CREATE
    	$user = $this->defaultUser();
    	$this->actingAs($user);
        $request = [
        	'wobjetivo' => 'Objetivo de prueba',
        	'incidencia' => 100,
            'year' => 2019,
        	'perspectiva_id' => 1
        ];

        $response = $this->post(route('objetivos.store'), $request);

        $objetivo_id = $response->original['objetivo_id'];
        $response->assertStatus(200);

        $this->assertDatabaseHas('objetivos', $request);

        // UPDATE
        $newRequest = [
        	'id' => $objetivo_id,
        	'wobjetivo' => 'Nuevo Objetivo',
        	'incidencia' => 50,
            'year' => 2019,
        	'perspectiva_id' => 1
        ];

        $response = $this->post(route('objetivos.update'), $newRequest);

        $response->assertStatus(200);

        $this->assertDatabaseHas('objetivos', $newRequest);

        // DESTROY
        $response = $this->delete("objetivos/destroy/{$objetivo_id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('objetivos', [ 'id'=>$objetivo_id ]);

    }
}
