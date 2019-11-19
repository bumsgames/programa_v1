<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_images', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('article_id')->unsigned();
            $table->integer('image_id')->unsigned();

            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')
                ->onDelete('restrict');

            $table->foreign('image_id')->references('id')->on('images')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_images');
    }
}
