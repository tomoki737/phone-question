<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function test_auth_user() {
        $response = $this->actingAs($this->user)->get(route('user'));
        $response->assertStatus(200)
        ->assertJson([
            'name' => $this->user->name,
        ]);
    }
    public function test_guest_user() {
        $response = $this->get(route('user'));
        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }
}
