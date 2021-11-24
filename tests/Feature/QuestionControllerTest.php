<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
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

    public function testStore()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->withoutMiddleware()->actingAs($user)
            ->post(route('questions.store'), ['question' => $question]);
        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
        ]);
    }
}
