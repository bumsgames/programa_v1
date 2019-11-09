<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('categories')->insert([
    		'category' => 'PlayStation 4 Primario | Cuenta Digital',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 4 Secundario | Cuenta Digital',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 4 Codigo | Codigo Digital',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 4 | Articulo Fisico',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 3 | Cupo Digital',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 3 | Articulo Fiscio',
    	]);

    	DB::table('categories')->insert([
    		'category' => 'PlayStation 3 | Codigo Digital',
    	]);

        DB::table('categories')->insert([
            'category' => 'Xbox One Primario | Cuenta Digital',
        ]);

        DB::table('categories')->insert([
            'category' => 'Xbox One Secundario | Cuenta Digital',
        ]);

        DB::table('categories')->insert([
            'category' => 'Xbox One Codigo | Codigo Digital',
        ]);

        DB::table('categories')->insert([
            'category' => 'Xbox One | Articulo Fisico',
        ]);

        DB::table('categories')->insert([
            'category' => 'Nintendo Digital | Cuenta Digital',
        ]);

        DB::table('categories')->insert([
            'category' => 'Nintendo Digital | Codigo Digital',
        ]);

        DB::table('categories')->insert([
            'category' => 'Nintendo | Articulo Fisico',
        ]);

        DB::table('categories')->insert([
            'category' => 'Otros | Articulo Fisico',
        ]);
    }
}
