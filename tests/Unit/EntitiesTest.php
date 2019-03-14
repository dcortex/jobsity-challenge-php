<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Entry;

class UserTest extends TestCase
{
    /**
     * Create User
     *
     * @return void
     */
    public function testUserCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->get("/authors/$user->id");
        $response->assertStatus(200);
        $user->delete();
    }

    /**
     * Delete User
     *
     * @return void
     */
    public function testUserDelete()
    {
        $user = factory(User::class)->create();
        $this->assertTrue($user->delete());
    }

    /**
     * Entry Forbidden
     *
     * @return void
     */
    public function testEntryForbidden()
    {
        $entry = factory(Entry::class)->create();
        $response = $this->get("/entries/$entry->id");
        $response->assertStatus(302);
        $entry->delete();
    }

    /**
     * Entry Access by Owner
     *
     * @return void
     */
    public function testEntryOwner()
    {
        $entry = factory(Entry::class)->create();
        $response = $this->actingAs($entry->user)->get("/entries/$entry->id");
        $response->assertStatus(200);
        $entry->delete();
    }
}
