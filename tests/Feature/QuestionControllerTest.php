<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200)
            ->assertViewIs('home');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('questions.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
        ->get(route('questions.create'));

        $response->assertStatus(200)
        ->assertViewIs('questions.create');
    }
}
