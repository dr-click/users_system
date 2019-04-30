<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiUsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $this->json('GET', 'api/users')
            ->assertStatus(200)
            ->assertJsonStructure([
              ["id", "name", "email", "email_verified_at", "created_at", "updated_at"]
            ]);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();

        $headers = ['CONTENT_TYPE' => "application/json"];
        $payload = [
            'name' => $user->name . '2',
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->json('PUT', '/api/users/' . $user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name . '2',
                'email' => $user->email
            ]);
    }

}