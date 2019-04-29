<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testResponse()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGuestSee()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee("Welcome");
        $response->assertDontSee("Home");
    }

    public function testLoginUserSee()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertSee("Welcome");
        $response->assertSee("Home");
    }
}
