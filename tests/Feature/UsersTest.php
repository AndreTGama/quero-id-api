<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function get_all_user()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function create_one_user()
    {
        $response = $this->postJson('/api/users', [
            "name" => "teste user",
            "email" => "teste@email.com.br",
            "password" => "123@Mudar"
        ]);

        $response->assertStatus(201);
    }
    /** @test */
    public function get_one_user()
    {
        $response = $this->getJson('/api/users/1');

        $response->assertStatus(200);
    }
}
