<?php

namespace Tests\Feature;

use App\Answer;
use App\User;
use App\Question;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->another_user = factory(User::class)->create();
        $this->question = factory(Question::class)->create(['user_id' => $this->user->id]);
        $this->answer = factory(Answer::class)->create(['user_id' => $this->user->id, 'question_id' => $this->question->id]);
        $this->comment = factory(Comment::class)->create(['user_id' => $this->user->id, 'answer_id' => $this->answer->id]);
        $this->answerData =  [
            'body' => 'テストデータ',
        ];
        $this->question_show_url = route('questions.show', ['question' => $this->question]);
    }
    public function testCommentCreate()
    {
        $response = $this->actingAs($this->user)
            ->from($this->question_show_url)
            ->put(route('answers.comment', ['answer' => $this->answer->id]), $this->answerData);
        $response->assertRedirect($this->question_show_url);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('comments', [
            'body' => $this->answerData['body']
        ]);
        $response = $this->get($this->question_show_url)
            ->assertStatus(200);
        $response->assertSeeText($this->answerData['body']);
    }

    public function testCommentDelete()
    {
        $response = $this->actingAs($this->user)
            ->from($this->question_show_url)
            ->delete(route('answers.uncomment', ['comment' => $this->comment]));
        $response->assertStatus(302)
            ->assertRedirect($this->question_show_url);
        $this->assertDatabaseMissing('comments', ['id' => $this->comment->id]);
    }
}
