<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_users')->insert([
            'name' =>'Admin',
            'description' => 'User who will have access to all features in the system'
        ]);

        DB::table('types_users')->insert([
            'name' =>'User',
            'description' => 'User who will have access to all features in the system',
            'private' => 0
        ]);
    }
}
