<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('article_id')->unsigned();
            $table->integer('client_id')->unsigned();

            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')
                ->onDelete('restrict');

            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
