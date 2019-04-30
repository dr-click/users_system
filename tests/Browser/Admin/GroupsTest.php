<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();

        $this->doLogin($user);
        $this->browse(function ($browser) use ($group) {
            $browser->visit($this->url() . '/admin/groups')
                    ->assertSee("Manage Groups")
                    ->assertSee($group->name)
                    ->assertSee("Delete");

        });
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $this->browse(function ($browser) use ($group) {
            $browser->visit($this->url() . '/admin/groups')
                    ->assertSee("Manage Groups")
                    ->assertSee($group->name)
                    ->clickLink('New Group')
                    ->assertSee("Create Group");

        });
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $this->browse(function ($browser) use ($group) {
            $group2 = factory(Group::class)->make();
            $browser->visit($this->url() . '/admin/groups')
                    ->assertSee("Manage Groups")
                    ->assertSee($group->name)
                    ->clickLink('New Group')
                    ->assertSee("Create Group")
                    ->type('name', $group2->name)
                    ->press('Create')
                    ->assertPathIs('/admin/groups')
                    ->assertSee($group2->name);

        });
    }

    public function testStoreWithInvalidData()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $this->browse(function ($browser) use ($group, $user) {
            $browser->visit($this->url() . '/admin/groups')
                    ->assertSee("Manage Groups")
                    ->assertSee($user->name)
                    ->clickLink('New Group')
                    ->assertSee("Create Group")
                    ->type('name', $group->name)
                    ->press('Create')
                    ->assertPathIs('/admin/groups/create')
                    ->assertSee("Create Group");

        });
    }
}