<?php

namespace Tests\Feature\Login;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;


class LoginTest extends TestCase
{
    use RefreshDatabase;
    /** In this case I'm doing a test with the @test comment which allows me to leave the functions
    * with any name I want and the other with the test_ (phpunit default)
    */

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        TypeUser::create([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ]);

        User::create([
            'name' => 'name',
            'email' => 'email@mail.com.br',
            'slug' => Str::slug('name'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'type_user_id' => 1,
        ]);

        $response = $this->post('/api/login', [
            "email" => "email@mail.com.br",
            "password" => "password"
        ]);

        $response->assertStatus(200);
    }
    /** @test */
    public function login()
    {
        TypeUser::create([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ]);

        User::create([
            'name' => 'name',
            'email' => 'email@mail.com.br',
            'slug' => Str::slug('name'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'type_user_id' => 1,
        ]);

        $response = $this->post('/api/login', [
            "email" => "email@mail.com.br",
            "password" => "password"
        ]);

        $response->assertStatus(200);
    }
    /** @test */
    public function login_error_email()
    {
        TypeUser::create([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ]);

        User::create([
            'name' => 'name',
            'email' => 'email@mail.com.br',
            'slug' => Str::slug('name'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'type_user_id' => 1,
        ]);

        $response = $this->post('/api/login', [
            "email" => "email@email.com.br",
            "password" => "password"
        ]);

        $response->assertStatus(400);
    }
    /** @test */
    public function login_error_password()
    {
        TypeUser::create([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ]);

        User::create([
            'name' => 'name',
            'email' => 'email@mail.com.br',
            'slug' => Str::slug('name'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'type_user_id' => 1,
        ]);

        $response = $this->post('/api/login', [
            "email" => "email@mail.com.br",
            "password" => "password123"
        ]);

        $response->assertStatus(401);
    }
}
