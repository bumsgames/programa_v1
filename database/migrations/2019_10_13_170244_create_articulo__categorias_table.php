<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_articulo')->unsigned();    
            $table->foreign('id_articulo')->references('id')
            ->on('articles')
            ->onDelete('cascade');
            $table->integer('id_categoria')->unsigned();    
            $table->foreign('id_categoria')->references('id')
            ->on('categories')
            ->onDelete('restrict');

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
        Schema::dropIfExists('articulo_categorias');
    }
}
