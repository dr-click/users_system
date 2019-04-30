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
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->assertSee($user->email)
                    ->assertSee("Edit")
                    ->assertSee("Delete");

        });
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink('Edit')
                    ->assertSee("Update User")
                    ->assertSee("Password");

        });
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink('Edit')
                    ->assertSee("Update User")
                    ->type('name', $user->name . '2')
                    ->type('password', 'password')
                    ->press('Update')
                    ->assertPathIs('/admin/users')
                    ->assertSee($user->name . '2');

        });
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit($this->url() . '/admin/users/')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink($user->id)
                    ->assertSee("User Details");

        });
    }
}