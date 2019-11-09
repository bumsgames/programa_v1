<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarritoAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_admin', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_admin')->unsigned();            
            $table->foreign('id_admin')->references('id')
            ->on('bums_users')
            ->onDelete('restrict');

            $table->integer('id_articulo')->unsigned();            
            $table->foreign('id_articulo')->references('id')
            ->on('articles')
            ->onDelete('restrict');

            $table->integer('cantidad')->unsigned();   

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
        Schema::dropIfExists('carrito_admin');
    }
}
