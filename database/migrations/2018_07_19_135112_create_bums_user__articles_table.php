<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumsUserArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bums_user_articles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_bumsuser')->unsigned();            
            $table->foreign('id_bumsuser')->references('id')->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_article')->unsigned();            
            $table->foreign('id_article')->references('id')->on('articles')
            ->onDelete('cascade');

            $table->integer('porcentaje')->unsigned()->default('0');           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bums_user__articles');
    }
}
