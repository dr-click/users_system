<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiGroupsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $group = factory(Group::class)->create();
        $this->json('GET', 'api/groups')
            ->assertStatus(200)
            ->assertJsonStructure([
              ["id", "name", "created_at", "updated_at"]
            ]);
    }
}