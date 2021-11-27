<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Question;
use App\User;
use App\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->another_user = factory(User::class)->create();
        $this->question = factory(Question::class)->create(['user_id' => $this->user->id]);
        $this->answer = factory(Answer::class)->create(['user_id' => $this->user->id, 'question_id' => $this->question->id]);
        $this->answerData =  [
            'body' => 'テストデータ',
        ];
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('questions.show', ['question' => $this->question]))
            ->assertStatus(200);
        $response = $this->actingAs($this->user)
            ->put(route('answers.store', ['question' => $this->question->id]), $this->answerData);
        $response->assertStatus(302);
        $response->assertRedirect(route('questions.show', ['question' => $this->question]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('answers', [
            'body' => 'テストデータ'
        ]);
        $response = $this->get(route('questions.show', ['question' => $this->question]))
            ->assertStatus(200);
        $response->assertSeeText('回答');
        $response->assertSeeText($this->answerData['body']);
    }

    public function testUpdate()
    {
        $response = $this->actingAs($this->user)
            ->get(route('answers.edit', ['answer' => $this->answer]));
        $update_url = route('answers.update', ['answer' => $this->answer]);
        $response = $this->put($update_url, $this->answerData);
        $response->assertStatus(302)
            ->assertRedirect(route(''));
        $this->assertDatabaseHas('answers', ['title' => 'テストデータ']);
    }
}
