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

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink('New User')
                    ->assertSee("Create User");

        });
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $user2 = factory(User::class)->make();
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink('New User')
                    ->assertSee("Create User")
                    ->type('name', $user2->name)
                    ->type('email', $user2->email)
                    ->type('password', 'password')
                    ->press('Create')
                    ->assertPathIs('/admin/users')
                    ->assertSee($user2->name);

        });
    }

    public function testStoreWithInvalidData()
    {
        $user = factory(User::class)->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit($this->url() . '/admin/users')
                    ->assertSee("Manage Users")
                    ->assertSee($user->name)
                    ->clickLink('New User')
                    ->assertSee("Create User")
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Create')
                    ->assertPathIs('/admin/users/create')
                    ->assertSee("Create User");

        });
    }
}