<?php

namespace Tests\Feature;

use App\Question;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use DatabaseTransactions;

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
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $questionData =  [
            'title' => 'テストデータ',
            'body' => 'テストデータ',
        ];
        $response = $this->actingAs($user)
            ->get(route('questions.create'));
        $response->assertStatus(200);
        $response->assertViewIs('questions.create');

        $response = $this->post(route('questions.store'), $questionData);
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
        $response->assertSeeText($questionData['title']);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $questionData =  [
            'title' => 'テストデータ',
            'body' => 'テストデータ',
        ];
        $response = $this->actingAs($user)
            ->get(route('questions.edit', ['question' => $question]));

        $update_url = route('questions.update', ['question' => $question]);
        $response = $this->put($update_url, $questionData);
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
        $this->assertDatabaseHas('questions', ['title' => 'テストデータ']);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->delete(route('questions.destroy', ['question' => $question->id]));
        $response->assertStatus(302)
            ->assertRedirect(route('home'));
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }
}
