<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
        $this->question = factory(Question::class)->create(['user_id' => $this->user->id]);
        $this->questionData =  [
            'title' => 'テストデータ',
            'body' => 'テストデータ',
        ];
    }
    public function testIsLikedByNull() {
        $result = $this->question->isLikedBy(null);
        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser() {
        $this->question->likes()->attach($this->user);
        $result = $this->question->isLikedBy($this->user);
        $this->assertTrue($result);
    }

    public function testIsLikedByAnotherUser() {
        $this->question->likes()->attach($this->user);
        $result = $this->question->isLikedBy($this->user);
        $this->assertTrue($result);
    }
}
