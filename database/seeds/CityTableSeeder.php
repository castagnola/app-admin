<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'id'=>1,
            'city_name' => 'Bogota',
            'status' => 1,
        ]);
    }
}
