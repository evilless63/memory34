<?php

use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'phone' => '',
            'adress' => '',
            'email' => '',
            'time' => '',
        ]);
    }
}
