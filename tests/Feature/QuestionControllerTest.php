<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use App\Answer;
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
        $this->answer = factory(Answer::class)->create(['user_id' => $this->user->id, 'question_id' => $this->question->id]);
        $this->question_show_url = route('questions.show', ['question_id' => $this->question->id]);
        $this->questionData =  [
            'title' => 'テストデータ',
            'body' => 'テストデータ',
        ];
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)->post(route('questions.store'), $this->questionData);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(200);
        $this->assertDatabaseHas('questions', [
            'title' => 'テストデータ',
        ]);

        $response = $this->get(route('un_solve'))
            ->assertStatus(200);
        $response = $this->get(route('un_solve'))
            ->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('questions.edit', ['question' => $this->question]));

        $update_url = route('questions.update', ['question' => $this->question]);
        $response = $this->put($update_url, $this->questionData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('questions', ['title' => 'テストデータ']);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('questions.destroy', ['question' => $this->question->id]));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('questions', ['id' => $this->question->id]);
    }

    public function testBestAnswer()
    {
        $response = $this->actingAs($this->user)
            ->from($this->question_show_url)
            ->put(route('questions.best_answer', ['question' => $this->question, 'answer' => $this->answer]));
        $response->assertStatus(302)
            ->assertRedirect($this->question_show_url);
        $this->assertDatabaseHas('questions', ['best_answer' => $this->answer->id]);
    }

    public function testSearch()
    {
        $content = $this->question->body;
        $response = $this->get(route('questions.search', ['content' => $content]));
        $response->assertStatus(200);
    }
}
