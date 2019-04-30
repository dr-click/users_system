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
        $this->actingAs($user)
             ->get('/admin/users')
             ->assertStatus(200)
             ->assertSee("Manage Users")
             ->assertSee($user->name)
             ->assertSee($user->email);
    }

    public function testGuestUser()
    {
        $user = factory(User::class)->create();
        $this->get('/admin/users')
             ->assertStatus(302)
             ->assertDontSee("Manage Users")
             ->assertDontSee($user->name)
             ->assertDontSee($user->email);
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
             ->get('/admin/users')
             ->assertStatus(200)
             ->assertSee("Manage Users")
             ->assertSee($user->name)
             ->assertSee($user->email);
    }

    public function testAuthorizedUserEdit()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->get('/admin/users/' . $user->id . '/edit')
             ->assertStatus(200)
             ->assertSee("Update User");
    }

    public function testGuestUserEdit()
    {
        $user = factory(User::class)->create();

        $this->get('/admin/users/' . $user->id . '/edit')
             ->assertStatus(302)
             ->assertDontSee("Update User");
    }
}