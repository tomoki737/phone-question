<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{

    use RefreshDatabase;
    public function test_register() {
        $data = [
            "name" => 'test',
            "email" => 'dummy@email.com',
            "password" => 'testtest',
            "password_confirmation" => 'testtest',
        ];
        $response = $this->post(route('register'), $data);
        $this->assertDatabaseHas('users', [
            "name" => "test"
        ]);
        $response->assertStatus(201)
        ->assertJson(["name" => "test"]);
    }
 }
