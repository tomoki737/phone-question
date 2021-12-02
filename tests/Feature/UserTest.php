<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
    }

    public function testIsFollowedByTheUser() {
        $this->user->followings()->attach($this->anotherUser);
        $result = $this->anotherUser->isFollowedBy($this->user);
        $this->assertTrue($result);
    }

    public function testIsFollowedByNull() {
        $result = $this->user->isFollowedBy(null);
        $this->assertFalse($result);
    }
}
