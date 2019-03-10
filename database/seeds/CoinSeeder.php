<?php

use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('coins')->insert([
    		'coin' => 'Bolivares',
    		'sign' => 'Bs',
            'imagen' => 'venezuela.jpg',
    	]);

    	DB::table('coins')->insert([
    		'coin' => 'Dolares',
    		'sign' => '$',
            'valor' => '1',
            'imagen' => 'usa.png',
    	]);

    	DB::table('coins')->insert([
    		'coin' => 'Peso Argentinos',
    		'sign' => 'ARS',
            'valor' => '30',
            'imagen' => 'argentina.png',
    	]);
    }
}
