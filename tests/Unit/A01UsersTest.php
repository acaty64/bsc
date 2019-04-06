<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class A01UsersTest extends TestCase
{
	use RefreshDatabase;

    public function testCRUDUser()
    {
    	// CREATE
    	$user = $this->defaultUser();
    	$this->actingAs($user);
        $request = [
        	'name' => 'NOMBRE',
            'lastname1' => 'APPATERNO',
            'lastname2' => 'APMATERNO',
            'nickname' => 'alias',
            'email' => 'prueba@gmail.com',
            'password' => 'secret',
        ];

        $response = $this->post(route('users.store'), $request);

        $user_id = $response->original['user_id'];
        $response->assertStatus(200);

        unset($request['password']);
        $this->assertDatabaseHas('users', $request);

        // UPDATE
        $newRequest = [
        	'id' => $user_id,
        	'name' => 'NEWNOMBRE',
            'lastname1' => 'NEWAPPATERNO',
            'lastname2' => 'NEWAPMATERNO',
            'nickname' => 'newalias',
            'email' => 'newprueba@gmail.com',
            'password' => 'secret',
        ];

        $response = $this->post(route('users.update'), $newRequest);

        $response->assertStatus(200);

        unset($newRequest['password']);
        $this->assertDatabaseHas('users', $newRequest);

        // DESTROY
        $response = $this->delete("users/destroy/{$user_id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', [ 'id'=>$user_id ]);

    }
}
