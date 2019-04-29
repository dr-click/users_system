<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthorizedUser()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200)
                 ->assertSee("Manage Users")
                 ->assertSee($user->name)
                 ->assertSee($user->email);
    }

    public function testGuestUser()
    {
        $user = factory(User::class)->create();
        $response = $this->get('/admin/users');

        $response->assertStatus(302)
                 ->assertDontSee("Manage Users")
                 ->assertDontSee($user->name)
                 ->assertDontSee($user->email);
    }
}