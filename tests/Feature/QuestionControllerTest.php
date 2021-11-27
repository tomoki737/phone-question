<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->question = factory(Question::class)->create(['user_id' => $this->user->id]);
        $this->questionData =  [
            'title' => 'テストデータ',
            'body' => 'テストデータ',
        ];
    }
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
        $response = $this->actingAs($this->user)
            ->get(route('questions.create'));

        $response->assertStatus(200)
            ->assertViewIs('questions.create');
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)
            ->get(route('questions.create'));
        $response->assertStatus(200);
        $response->assertViewIs('questions.create');

        $response = $this->post(route('questions.store'), $this->questionData);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('questions', [
            'title' => 'テストデータ',
        ]);

        $response = $this->get(route('home'))
            ->assertStatus(200);
        $response->assertSeeText('一覧');
        $response = $this->get(route('home'))
        ->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSeeText($this->questionData['title']);
    }

    public function testUpdate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('questions.edit', ['question' => $this->question]));

        $update_url = route('questions.update', ['question' => $this->question]);
        $response = $this->put($update_url, $this->questionData);
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
        $this->assertDatabaseHas('questions', ['title' => 'テストデータ']);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('questions.destroy', ['question' => $this->question->id]));
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
        $this->assertDatabaseMissing('questions', ['id' => $this->question->id]);
    }
}
