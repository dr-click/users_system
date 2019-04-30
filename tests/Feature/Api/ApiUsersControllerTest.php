<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
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
            'group_id' => $user->group_id,
            'password' => 'password'
        ];

        $response = $this->json('PUT', '/api/users/' . $user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name . '2',
                'group_id' => $user->group_id,
                'email' => $user->email
            ]);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $this->json('GET', 'api/users/' . $user->id)
            ->assertStatus(200)
            ->assertJsonStructure([
              "id", "name", "email", "email_verified_at", "created_at", "updated_at"
            ]);
    }

}