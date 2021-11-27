<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use DatabaseTransactions;

    public function testIsLikedByNull() {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $result = $question->isLikedBy(null);
        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser() {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $question->likes()->attach($user);
        $result = $question->isLikedBy($user);
        $this->assertTrue($result);
    }

    public function testIsLikedByAnotherUser() {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $question->likes()->attach($user);
        $result = $question->isLikedBy($anotherUser);
        $this->assertFalse($result);
    }
}
