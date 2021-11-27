<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Question;
use App\User;
use App\Answer;

class AnswerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $answer = factory(Answer::class)->create(['user_id' => $user->id, 'question_id' => $question->id]);
        $answerData =  [
            'body' => 'テストデータ',
        ];
        $question_show_url = route('questions.show', ['question' => $question]);
        $response = $this->actingAs($user)
            ->get($question_show_url)
            ->assertStatus(200);
        $response = $this->actingAs($user)
            ->put(route('answers.store', ['question' => $question->id]), $answerData);
        $response->assertStatus(302);
        $response->assertRedirect($question_show_url);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('answers', [
            'body' => 'テストデータ'
        ]);
        $response = $this->get($question_show_url)
            ->assertStatus(200);
        $response->assertSeeText('回答');
        $response->assertSeeText($answerData['body']);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $answer = factory(Answer::class)->create(['user_id' => $user->id, 'question_id' => $question->id]);
        $answerData =  [
            'body' => 'テストデータ',
        ];
        $question_show_url = route('questions.show', ['question' => $question]);
        $response = $this->actingAs($user)
            ->get(route('answers.edit', ['answer' => $answer]));
        $update_url = route('answers.update', ['answer' => $answer]);
        $response = $this->put($update_url, $answerData);
        $response->assertStatus(302)
            ->assertRedirect($question_show_url);
        $this->assertDatabaseHas('answers', ['body' => 'テストデータ']);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $question_show_url = route('questions.show', ['question' => $question]);
        $answer = factory(Answer::class)->create(['user_id' => $user->id, 'question_id' => $question->id]);
        $response = $this->actingAs($user)
            ->from($question_show_url)
            ->delete(route('answers.destroy', ['answer' => $answer]));
        $response->assertStatus(302)
            ->assertRedirect($question_show_url);
        $this->assertDatabaseMissing('answers', ['id' => $answer->id]);
    }
}
