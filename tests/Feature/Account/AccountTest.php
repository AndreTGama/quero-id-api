<?php

namespace Tests\Feature\Account;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_account()
    {
        TypeUser::create([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ], [
            'name' =>'User',
            'description' => 'User who will have access to all features in the system'
        ]);

        $response = $this->post('/api/account', [
            "name" => "Andre Gama",
            "email" => "andre_gama789@hotmail.com",
            "password" => "123@Mudar"
        ]);

        dd($response);
        $response->assertStatus(200);
    }
}
