<?php

use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacion')->insert([
            'nombre_ubicacion' => 'Rio Aro',
        ]);

        DB::table('ubicacion')->insert([
            'nombre_ubicacion' => 'Tienda Alta Vista',
        ]);
    }
    
}
