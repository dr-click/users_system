<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testResponse()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGuestSee()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertSee("Dashboard")
                 ->assertSee("Welcome")
                 ->assertDontSee("Home");
    }

    public function testLoginUserSee()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertSee("Welcome")
                 ->assertSee("Home")
                 ->assertSee("Users");
    }
}
