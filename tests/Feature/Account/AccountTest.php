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
            'name' => 'Jhon Jhones',
            'email' => 'jhon_jhones@hotmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }
    /**
     * test_create_account_with_equal_email
     *
     * @return void
     */
    public function test_create_account_with_equal_email()
    {
        \App\Models\TypeUser::factory(2)->create();

        User::create([
            'name' => 'Jhon Jhones',
            'email' => 'jhon_jhones@hotmail.com',
            'slug' => Str::slug('jhon_Jhones'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/account', [
            'name' => 'Jhon Jhones',
            'email' => 'jhon_jhones@hotmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(400);
    }
    /**
     * test_create_account_max_input_email
     *
     * @return void
     */
    public function test_create_account_max_input_email()
    {
        \App\Models\TypeUser::factory(2)->create();

        $string =  Str::random(260);
        $email = "$string@email.com";

        $response = $this->post('/api/account', [
            'name' => 'Jhon Jhones',
            'email' => $email,
            'password' => 'password'
        ]);

        $response->assertStatus(400);
    }
    /**
     * test_create_account_max_input_name
     *
     * @return void
     */
    public function test_create_account_max_input_name()
    {
        \App\Models\TypeUser::factory(2)->create();

        $name =  Str::random(260);

        $response = $this->post('/api/account', [
            'name' => $name,
            'email' => 'jhon_jhones@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(400);
    }
}
