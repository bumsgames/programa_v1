<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'id' => '2',
        	'id_creator' => '2',
        	'name' => 'Devolucion',
        	'category' => '1',
        	'price_in_dolar' => '0',
            'offer_price' => '0',
            'quantity' => '0',
            'oferta' => '0',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Red dead redemption 2',
        	'category' => '1',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '88',
            'oferta' => '0',
            'email' => 'reddead@gmail.com',
            'password' => 'rdd2',
            'nickname' => 'redo2',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Red dead redemption 2',
        	'category' => '2',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '88',
            'oferta' => '1',
            'email' => 'reddead@gmail.com',
            'password' => 'rdd2',
            'nickname' => 'redo2',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '3',
        	'name' => 'Red dead redemption 2',
        	'category' => '4',
        	'price_in_dolar' => '50',
            'offer_price' => '45',
            'quantity' => '1',
            'oferta' => '0',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Dark Souls 3',
        	'category' => '2',
        	'price_in_dolar' => '8',
            'offer_price' => '5',
            'quantity' => '1',
            'peso' => '52',
            'oferta' => '0',
            'email' => 'darks@gmail.com',
            'password' => 'ds3rk',
            'nickname' => 'solaire',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Dark Souls 3',
        	'category' => '1',
        	'price_in_dolar' => '25',
            'offer_price' => '20',
            'quantity' => '1',
            'peso' => '52',
            'oferta' => '1',
            'email' => 'darks@gmail.com',
            'password' => 'ds3rk',
            'nickname' => 'solaire',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Dark Souls 3',
        	'category' => '4',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'oferta' => '1',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Monster Hunter: Worlds',
        	'category' => '8',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '67',
            'oferta' => '0',
            'email' => 'mhwrld@gmail.com',
            'password' => 'mhunter',
            'nickname' => 'hunterw',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Monster Hunter: Worlds',
        	'category' => '9',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '67',
            'oferta' => '0',
            'email' => 'mhwrld@gmail.com',
            'password' => 'mhunter',
            'nickname' => 'hunterw',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
            'id_creator' => '1',
        	'name' => 'Monster Hunter: Worlds',
        	'category' => '9',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '67',
            'oferta' => '0',
            'email' => 'hunterwrld@gmail.com',
            'password' => 'mhunterwrld2',
            'nickname' => 'mwhunter',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
            'id_creator' => '3',
        	'name' => 'Monster Hunter: Worlds',
        	'category' => '8',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '67',
            'oferta' => '0',
            'email' => 'hunterwrld@gmail.com',
            'password' => 'mhunterwrld2',
            'nickname' => 'mwhunter',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Just Cause 3 XXL',
        	'category' => '1',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '75',
            'oferta' => '0',
            'email' => 'jcause@gmail.com',
            'password' => 'justcs',
            'nickname' => 'jcuaus',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Bayonetta',
        	'category' => '5',
        	'price_in_dolar' => '10',
            'offer_price' => '6',
            'quantity' => '4',
            'peso' => '15',
            'oferta' => '0',
            'email' => 'bayonetta@gmail.com',
            'password' => 'cherry',
            'nickname' => 'bayonet',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '3',
        	'name' => 'Doom',
        	'category' => '1',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '45',
            'oferta' => '0',
            'email' => 'doom@gmail.com',
            'password' => 'd00m',
            'nickname' => 'doomguy',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '3',
        	'name' => 'Doom',
        	'category' => '2',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '45',
            'oferta' => '0',
            'email' => 'doom@gmail.com',
            'password' => 'd00m',
            'nickname' => 'doomguy',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '3',
        	'name' => 'Doom',
        	'category' => '8',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '45',
            'oferta' => '0',
            'email' => 'doom@gmail.com',
            'password' => 'd00m',
            'nickname' => 'doomguy',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Doom',
        	'category' => '9',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '45',
            'oferta' => '0',
            'email' => 'doom@gmail.com',
            'password' => 'd00m',
            'nickname' => 'doomguy',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '2',
        	'name' => 'Fifa 19',
        	'category' => '1',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '35',
            'oferta' => '0',
            'email' => 'fifa19@gmail.com',
            'password' => 'messi19',
            'nickname' => 'ronalmess',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'Fifa 19',
        	'category' => '9',
        	'price_in_dolar' => '30',
            'offer_price' => '25',
            'quantity' => '1',
            'peso' => '35',
            'oferta' => '1',
            'email' => 'fifa19@gmail.com',
            'password' => 'messi19',
            'nickname' => 'ronalmess',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '1',
        	'name' => 'God of War 3',
        	'category' => '5',
        	'price_in_dolar' => '10',
            'offer_price' => '7',
            'quantity' => '1',
            'peso' => '34',
            'oferta' => '0',
            'email' => 'gow3@gmail.com',
            'password' => 'godow3',
            'nickname' => 'kratos',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);

        DB::table('articles')->insert([
        	'id_creator' => '3',
        	'name' => 'Super Smash Bros. Ultimate',
        	'category' => '12',
        	'price_in_dolar' => '40',
            'offer_price' => '35',
            'quantity' => '1',
            'peso' => '24',
            'oferta' => '1',
            'email' => 'smashbros@gmail.com',
            'password' => 'ssbu',
            'nickname' => 'smashultimate',
            'fondo' => 'azar.jpg',
            'created_at'=>'2018-11-25 00:00:00.000000',
            'updated_at'=>'2018-11-25 00:00:00.000000'
        ]);
      
    }
}
