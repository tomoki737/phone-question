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
        $this->question_show_url = route('questions.show', ['question' => $this->question]);
    }

    public function testCreate()
    {

        $response = $this->actingAs($this->user)
            ->get($this->question_show_url)
            ->assertStatus(200);
        $response = $this->actingAs($this->user)
            ->put(route('answers.store', ['question' => $this->question->id]), $this->answerData);
        $response->assertStatus(302);
        $response->assertRedirect($this->question_show_url);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('answers', [
            'body' => 'テストデータ'
        ]);
        $response = $this->get($this->question_show_url)
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
            ->assertRedirect($this->question_show_url);
        $this->assertDatabaseHas('answers', ['body' => 'テストデータ']);
    }

    public function testDelete()
    {
        $response = $this->actingAs($this->user)
            ->from( $this->question_show_url)
            ->delete(route('answers.destroy', ['answer' => $this->answer]));
        $response->assertStatus(302)
            ->assertRedirect($this->question_show_url);
        $this->assertDatabaseMissing('answers', ['id' => $this->answer->id]);
    }
}
