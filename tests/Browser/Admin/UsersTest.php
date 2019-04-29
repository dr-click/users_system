<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $this->doLogin($user);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('http://localhost:8000/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->assertSee($user->email)
                    ->assertSee("Edit")
                    ->assertSee("Delete");

        });
    }
}