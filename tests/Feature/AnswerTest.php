<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Question;
use APP\Answer;

class AnswerTest extends TestCase
{

    public function testStore()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $response = $this->withoutMiddleware()->actingAs($user)
            ->post(route('answer.store'), ['question_id' => $question,
        'answer' => ]);
        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
        ]);
    }
}
