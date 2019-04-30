<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthorizedGroups()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $this->actingAs($user)
             ->get('/admin/groups')
             ->assertStatus(200)
             ->assertSee("Manage Groups")
             ->assertSee($group->name);
    }

    public function testGuestGroups()
    {
        $group = factory(Group::class)->create();
        $this->get('/admin/groups')
             ->assertStatus(302)
             ->assertDontSee("Manage Groups")
             ->assertDontSee($group->name);
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $this->actingAs($user)
             ->get('/admin/groups')
             ->assertStatus(200)
             ->assertSee("Manage Groups")
             ->assertSee($group->name);
    }

    public function testAuthorizedGroupCreate()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
             ->get('/admin/groups/create')
             ->assertStatus(200)
             ->assertSee("Create Group");
    }

    public function testGuestGroupCreate()
    {
        $group = factory(Group::class)->create();
        $this->get('/admin/groups/create')
             ->assertStatus(302)
             ->assertDontSee("Create Group");
    }
}