<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('todo.index'));

        $response->assertStatus(200)
            ->assertViewIs('todoList.index');
    }
}
