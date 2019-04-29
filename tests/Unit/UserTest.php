<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
  use RefreshDatabase;

  public function testDatabase()
  {
    $user = factory(User::class)->create();

    $this->assertDatabaseHas('users', [
      'name' => $user->name
    ]);

    $this->assertDatabaseHas('users', [
      'email' => $user->email
    ]);
  }

}
