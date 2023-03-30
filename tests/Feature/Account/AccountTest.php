<?php

namespace Tests\Feature\Account;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_account()
    {
        \App\Models\TypeUser::factory(2)->create();

        $response = $this->post('/api/account', [
            "name" => "Andre Gama",
            "email" => "andre_gama789@hotmail.com",
            "password" => "123@Mudar"
        ]);

        $response->assertStatus(201);
    }
}
