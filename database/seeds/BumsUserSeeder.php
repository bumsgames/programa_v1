<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BumsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bums_users')->insert([
        	'name' => 'Angel',
        	'lastname' => 'Duarte',
        	'nickname' => 'crack',
        	'email' => 'davik.1010@gmail.com',
        	'level' => '10'
        ]);

        DB::table('bums_users')->insert([
            'name' => 'Daniel',
            'lastname' => 'Duarte',
            'nickname' => 'crack2',
            'email' => 'davik.1010@gmail.com2',
            'level' => '1'
        ]);

        DB::table('bums_users')->insert([
            'name' => 'Genesis',
            'lastname' => 'Moreno',
            'nickname' => 'crack3',
            'email' => 'davik.1010@gmail.com3',
            'level' => '1'
        ]);

    }
}
