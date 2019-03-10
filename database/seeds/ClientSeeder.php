<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => 'No',
            'lastname' => 'Aplica',
            'nickname' => 'sdfjnfdsljsdfmldfslksdf',
            'email' => 'dsfjlndfsjldfsjldfs',
        ]);
    }
}
