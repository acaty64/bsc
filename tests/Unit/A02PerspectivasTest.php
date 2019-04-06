<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class A02PerspectivasTest extends TestCase
{
	use RefreshDatabase;

    public function testCRUDPerspectivas()
    {
    	// CREATE
    	$user = $this->defaultUser();
    	$this->actingAs($user);
        $request = [
        	'wperspectiva' => 'Perspectiva de prueba'
        ];

        $response = $this->post(route('perspectivas.store'), $request);

        $perspectiva_id = $response->original['perspectiva_id'];
        $response->assertStatus(200);

        $this->assertDatabaseHas('perspectivas', $request);

        // UPDATE
        $newRequest = [
        	'id' => $perspectiva_id,
        	'wperspectiva' => 'Nueva Perspectiva'
        ];

        $response = $this->post(route('perspectivas.update'), $newRequest);

        $response->assertStatus(200);

        $this->assertDatabaseHas('perspectivas', $newRequest);

        // DESTROY
        $response = $this->delete("perspectivas/destroy/{$perspectiva_id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('perspectivas', [ 'id'=>$perspectiva_id ]);

    }
}
