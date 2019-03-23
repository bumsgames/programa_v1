<?php

use Illuminate\Database\Seeder;

class BancoEmisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banco_emisor')->insert([
            'id' => '1',
            'banco' => 'Banesco Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '2',
            'banco' => 'Provincial Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '3',
            'banco' => 'Mercantil Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '4',
            'banco' => 'Mercantil Sulay Salazar',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '5',
            'banco' => 'Venezuela Sulay Salazar',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '6',
            'banco' => 'Venezuela Genesis Moreno',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '7',
            'banco' => 'Bnc Alejandro Duarte',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '8',
            'banco' => 'Paypal Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '9',
            'banco' => 'LocalBitcoins Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '10',
            'banco' => 'UpHold Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '11 ',
            'banco' => 'AirTM Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '12',
            'banco' => 'MercadoPago Argentina Angel David',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '13',
            'banco' => 'MercadoPago Argentina Nestor Rojas',
        ]);
        DB::table('banco_emisor')->insert([
            'id' => '14',
            'banco' => 'MercadoPago Brasil Angel David',
        ]);
    }
}
