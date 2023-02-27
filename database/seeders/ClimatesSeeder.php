<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClimatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('climates')->insert([
            'name' =>'Equatorial',
        ]);

        DB::table('climates')->insert([
            'name' =>'Tropical',
        ]);

        DB::table('climates')->insert([
            'name' =>'Temperate',
        ]);

        DB::table('climates')->insert([
            'name' =>'Subtropical',
        ]);

        DB::table('climates')->insert([
            'name' =>'Mediterranean',
        ]);

        DB::table('climates')->insert([
            'name' =>'Cold',
        ]);

        DB::table('climates')->insert([
            'name' =>'Cold Mountain',
        ]);

        DB::table('climates')->insert([
            'name' =>'Polar',
        ]);

        DB::table('climates')->insert([
            'name' =>'Desert',
        ]);
        
        DB::table('climates')->insert([
            'name' =>'Semi-arid',
        ]);
    }
}
