<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(BumsUserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CoinSeeder::class);
    }
}
